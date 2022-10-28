<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\User;
use Inertia\Inertia;
use App\Models\Holiday;
use App\Models\Attendance;
use Illuminate\Http\Request;
use App\Http\Requests\StoreAttendanceRequest;
use App\Http\Requests\UpdateAttendanceRequest;

class AttendanceController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data = $this->summaryData();
        dd($data);
        return Inertia::render('Attandencies');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreAttendanceRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreAttendanceRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Attendance  $attendance
     * @return \Illuminate\Http\Response
     */
    public function show(Attendance $attendance)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Attendance  $attendance
     * @return \Illuminate\Http\Response
     */
    public function edit(Attendance $attendance)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateAttendanceRequest  $request
     * @param  \App\Models\Attendance  $attendance
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateAttendanceRequest $request, Attendance $attendance)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Attendance  $attendance
     * @return \Illuminate\Http\Response
     */
    public function destroy(Attendance $attendance)
    {
        //
    }

    public function summaryData(Request $request)
    {
        $month = '09';
        $year = '2022';
        $employees = User::with(
            ['attendance' => function ($query) use ($request, $month, $year) {
                $query->whereRaw('MONTH(attendances.clock_in_time) = ?', [$month])
                    ->whereRaw('YEAR(attendances.clock_in_time) = ?', [$year]);

                if ($request->late != 'all') {
                    $query = $query->where('attendances.late', $request->late);
                }
            },
            'leaves' => function ($query) use ($request, $month, $year) {
                $query->whereRaw('MONTH(leaves.leave_date) = ?', [$month])
                    ->whereRaw('YEAR(leaves.leave_date) = ?', [$year])
                    ->where('status', 'approved');
            },
            'shifts' => function ($query) use ($request, $month, $year) {
                $query->whereRaw('MONTH(employee_shift_schedules.date) = ?', [$month])
                    ->whereRaw('YEAR(employee_shift_schedules.date) = ?', [$year]);
            }
            ]
        )
        // ->join('role_user', 'role_user.user_id', '=', 'users.id')
        //     ->join('roles', 'roles.id', '=', 'role_user.role_id')
            ->leftJoin('employee_details', 'employee_details.user_id', '=', 'users.id')
            ->select('users.id', 'users.name', 'users.email', 'users.created_at', 'employee_details.department_id', 'users.image')
            // ->where('roles.name', '<>', 'client')
            ->orderBy('users.id');

        // if ($request->department != 'all') {
        //     $employees = $employees->where('employee_details.department_id', $request->department);
        // }

        // if ($request->userId != 'all') {
        //     $employees = $employees->where('users.id', $request->userId);
        // }

        // if ($this->viewAttendancePermission == 'owned') {
        //     $employees = $employees->where('users.id', user()->id);
        // }

        // dd($employees->get());

        $employees = $employees->get();

        $this->holidays = Holiday::whereRaw('MONTH(holidays.date) = ?', [$month])->whereRaw('YEAR(holidays.date) = ?', [$year])->get();

        $final = [];
        $holidayOccasions = [];

        $this->daysInMonth = Carbon::parse('01-' . $month . '-' . $year)->daysInMonth;
        $now = Carbon::now()->timezone('Africa/Kampala');
        $requestedDate = Carbon::parse(Carbon::parse('01-' . $month . '-' . $year))->endOfMonth();

        foreach ($employees as $employee) {

            $dataBeforeJoin = null;

            $dataTillToday = array_fill(1, $now->copy()->format('d'), 'Absent');

            if (($now->copy()->format('d') != $this->daysInMonth) && !$requestedDate->isPast()) {
                $dataFromTomorrow = array_fill($now->copy()->addDay()->format('d'), ((int)$this->daysInMonth - (int)$now->copy()->format('d')), '-');
            }
            else {
                $dataFromTomorrow = array_fill($now->copy()->addDay()->format('d'), ((int)$this->daysInMonth - (int)$now->copy()->format('d')), 'Absent');
            }

            $final[$employee->id . '#' . $employee->name] = array_replace($dataTillToday, $dataFromTomorrow);

            $shiftScheduleCollection = $employee->shifts->keyBy('date');

            foreach ($employee->attendance as $attendance) {
                $clockInTime = Carbon::createFromFormat('Y-m-d H:i:s', $attendance->clock_in_time->timezone(global_setting()->timezone)->toDateTimeString(), 'UTC');

                if (isset($shiftScheduleCollection[$clockInTime->copy()->startOfDay()->toDateTimeString()])) {
                    $shiftStartTime = Carbon::parse($clockInTime->copy()->toDateString() . ' ' . $shiftScheduleCollection[$clockInTime->copy()->startOfDay()->toDateTimeString()]->shift->office_start_time);
                    $shiftEndTime = Carbon::parse($clockInTime->copy()->toDateString() . ' ' . $shiftScheduleCollection[$clockInTime->copy()->startOfDay()->toDateTimeString()]->shift->office_end_time);

                    if ($clockInTime->between($shiftStartTime, $shiftEndTime)) {
                        $final[$employee->id . '#' . $employee->name][$clockInTime->day] = '<a href="javascript:;" class="view-attendance" data-attendance-id="' . $attendance->id . '"><i class="fa fa-check text-primary"></i></a>';

                    } elseif($clockInTime->betweenIncluded($shiftStartTime->copy()->subDay(), $shiftEndTime->copy()->subDay())) {
                        $final[$employee->id . '#' . $employee->name][$clockInTime->copy()->subDay()->day] = '<a href="javascript:;" class="view-attendance" data-attendance-id="' . $attendance->id . '"><i class="fa fa-check text-primary"></i></a>';
                    }

                } else {
                    $final[$employee->id . '#' . $employee->name][$clockInTime->day] = '<a href="javascript:;" class="view-attendance" data-attendance-id="' . $attendance->id . '"><i class="fa fa-check text-primary"></i></a>';
                }
            }

            // $emplolyeeName = view('components.employee', [
            //     'user' => $employee
            // ]);


            $emplolyeeName =Inertia::render('Employee',['user' => $employee ]);

            $final[$employee->id . '#' . $employee->name][] = $emplolyeeName;

            if (Carbon::parse($employee->employeeDetail->joining_date)->greaterThan(Carbon::parse('01-' . $month . '-' . $year))) {
                if($month == $employee->employeeDetail->joining_date->format('m') && $year == $employee->employeeDetail->joining_date->format('Y')){
                    if($employee->employeeDetail->joining_date->format('d') == '01'){
                        $dataBeforeJoin = array_fill(1, $employee->employeeDetail->joining_date->format('d'), '-');
                    }
                    else{
                        $dataBeforeJoin = array_fill(1, $employee->employeeDetail->joining_date->subDay()->format('d'), '-');
                    }
                }

                if(($month < $employee->employeeDetail->joining_date->format('m') && $year == $employee->employeeDetail->joining_date->format('Y')) || $year < $employee->employeeDetail->joining_date->format('Y'))
                {
                    $dataBeforeJoin = array_fill(1, $this->daysInMonth, '-');
                }
            }

            if(Carbon::parse('01-' . $month . '-' . $year)->isFuture()){
                $dataBeforeJoin = array_fill(1, $this->daysInMonth, '-');
            }

            if(!is_null($dataBeforeJoin)){
                $final[$employee->id . '#' . $employee->name] = array_replace($final[$employee->id . '#' . $employee->name], $dataBeforeJoin);
            }

            foreach ($employee->leaves as $leave) {
                $final[$employee->id . '#' . $employee->name][$leave->leave_date->day] = 'Leave';
            }

            foreach ($this->holidays as $holiday) {
                if ($final[$employee->id . '#' . $employee->name][$holiday->date->day] == 'Absent' || $final[$employee->id . '#' . $employee->name][$holiday->date->day] == '-') {
                    $final[$employee->id . '#' . $employee->name][$holiday->date->day] = 'Holiday';
                    $holidayOccasions[$holiday->date->day] = $holiday->occassion;
                }
            }
        }

        $this->employeeAttendence = $final;
        $this->holidayOccasions = $holidayOccasions;
        $this->weekMap = [
            0 => 'Su',
            1 => 'Mo',
            2 => 'Tu',
            3 => 'We',
            4 => 'Th',
            5 => 'Fr',
            6 => 'Sa',
        ];
        $this->month = $month;
        $this->year = $year;
        // dd($weekMap[\Carbon\Carbon::parse(\Carbon\Carbon::parse($i . '-' . $month . '-' . $year))->dayOfWeek]);
        // return $this->data;
        return Inertia::render('Attandencies',['attendancies'=>$this->data]);
        // return Reply::dataOnly(['status' => 'success', 'data' => $view]);
    }
}
