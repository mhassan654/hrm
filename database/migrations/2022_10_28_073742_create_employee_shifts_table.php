<?php

use App\Models\EmployeeShift;
use App\Models\AttendanceSetting;
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('employee_shifts', function (Blueprint $table) {
            $table->id();
            $table->string('shift_name');
            $table->string('shift_short_code');
            $table->string('color');
            $table->time('office_start_time');
            $table->time('office_end_time');
            $table->time('halfday_mark_time')->nullable();
            $table->tinyInteger('late_mark_duration');
            $table->tinyInteger('clockin_in_day');
            $table->text('office_open_days');
            $table->timestamps();
        });

        Schema::create('employee_shift_schedules', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('user_id')->unsigned();
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade')->onUpdate('cascade');
            $table->date('date');
            $table->bigInteger('employee_shift_id')->unsigned();
            $table->foreign('employee_shift_id')->references('id')->on('employee_shifts')->onDelete('cascade')->onUpdate('cascade');
            $table->bigInteger('added_by')->unsigned()->nullable();
            $table->foreign('added_by')->references('id')->on('users')->onDelete('SET NULL')->onUpdate('cascade');

            $table->bigInteger('last_updated_by')->unsigned()->nullable();
            $table->foreign('last_updated_by')->references('id')->on('users')->onDelete('SET NULL')->onUpdate('cascade');
            $table->timestamps();
        });

        $attendanceSettings = AttendanceSetting::first();

        $employeeShift = new EmployeeShift();
        $employeeShift->shift_name = 'General Shift';
        $employeeShift->shift_short_code = 'GS';
        $employeeShift->color = '#99C7F1';
        $employeeShift->office_start_time = $attendanceSettings->office_start_time;
        $employeeShift->office_end_time = $attendanceSettings->office_end_time;
        $employeeShift->halfday_mark_time = $attendanceSettings->halfday_mark_time;
        $employeeShift->late_mark_duration = $attendanceSettings->late_mark_duration;
        $employeeShift->clockin_in_day = $attendanceSettings->clockin_in_day;
        $employeeShift->office_open_days = $attendanceSettings->office_open_days;
        $employeeShift->save();

        Schema::table('attendance_settings', function (Blueprint $table) use ($employeeShift) {
            $table->bigInteger('default_employee_shift')->unsigned()->nullable()->default($employeeShift->id);
            $table->foreign('default_employee_shift')->references('id')->on('employee_shifts')->onDelete('SET  NULL')->onUpdate('cascade');
            $table->string('week_start_from')->default(1);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('attendance_settings', function (Blueprint $table) {
            $table->dropForeign(['default_employee_shift']);
            $table->dropColumn(['default_employee_shift']);
            $table->dropColumn(['week_start_from']);
        });

        Schema::dropIfExists('employee_shift_schedules');
        Schema::dropIfExists('employee_shifts');
    }
};
