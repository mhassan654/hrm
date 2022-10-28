<?php

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
        $json = json_encode([1,2,3,4,5]);
        Schema::create('attendance_settings', function (Blueprint $table) use ($json){
            $table->increments('id');
            $table->time('office_start_time');
            $table->time('office_end_time');
            $table->tinyInteger('late_mark_duration');
            $table->enum('employee_clock_in_out', ['yes', 'no'])->default('yes');
            $table->integer('clockin_in_day')->default(2);
            $table->time('halfday_mark_time')->nullable()->default(null);
            $table->string('office_open_days')->default($json);
            $table->timestamps();
        });

        $setting = new AttendanceSetting();
        $setting->office_start_time = '09:00:00';
        $setting->office_end_time = '18:00:00';
        $setting->late_mark_duration = 20;
        $setting->save();
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('attendance_settings');
    }
};
