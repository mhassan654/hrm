<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;
    /**
     *  * @property-read \App\Models\EmployeeDetails|null $employeeDetail
     */

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public static function allEmployees($exceptId = null, $active = false, $overRidePermission = null)
    {
        if (!isRunningInConsoleOrSeeding() && !is_null($overRidePermission)) {
            $viewEmployeePermission = $overRidePermission;

        }
        elseif (!isRunningInConsoleOrSeeding() && user()) {
            $viewEmployeePermission = user()->permission('view_employees');
        }

        $users = User::withRole('employee')
            ->join('employee_details', 'employee_details.user_id', '=', 'users.id')
            ->leftJoin('designations', 'employee_details.designation_id', '=', 'designations.id')
            ->select('users.id', 'users.name', 'users.email', 'users.created_at', 'users.image', 'designations.name as designation_name', 'users.email_notifications', 'users.mobile', 'users.country_id');

        if (!is_null($exceptId)) {
            $users->where('users.id', '<>', $exceptId);
        }

        if (!$active) {
            $users->withoutGlobalScope('active');
        }

        // if (!isRunningInConsoleOrSeeding() && user() && isset($viewEmployeePermission)) {
        //     if ($viewEmployeePermission == 'added' && !in_array('client', user_roles())) {
        //         $users->where(function ($q) {
        //             $q->where('employee_details.user_id', user()->id);
        //             $q->orWhere('employee_details.added_by', user()->id);
        //         });

        //     }
        //     elseif ($viewEmployeePermission == 'owned' && !in_array('client', user_roles())) {
        //         $users->where('users.id', user()->id);

        //     }
        //     elseif ($viewEmployeePermission == 'both' && !in_array('client', user_roles())) {
        //         $users->where(function ($q) {
        //             $q->where('employee_details.user_id', user()->id);
        //             $q->orWhere('employee_details.added_by', user()->id);
        //         });

        //     }
        //     elseif (($viewEmployeePermission == 'none' || $viewEmployeePermission == '') && !in_array('client', user_roles())) {
        //         $users->where('users.id', user()->id);
        //     }
        // }

        $users->orderBy('users.name', 'asc');
        $users->groupBy('users.id');
        return $users->get();;
    }

    public function employeeDetail()
    {
        return $this->hasOne(EmployeeDetails::class, 'user_id');
    }

    public function employeeDetails()
    {
        return $this->hasOne(EmployeeDetails::class);
    }

    public function employee()
    {
        return $this->hasMany(EmployeeDetails::class, 'user_id');
    }

    public function attendance()
    {
        return $this->hasMany(Attendance::class, 'user_id');
    }

    public function leaves()
    {
        return $this->hasMany(Leave::class, 'user_id');
    }

    public function shifts()
    {
        return $this->hasMany(EmployeeShiftSchedule::class, 'user_id');
    }
}
