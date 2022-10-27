<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\EmployeeDetails;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use SebastianBergmann\Comparator\Factory;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class UsersSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('users')->delete();

        DB::statement('ALTER TABLE users AUTO_INCREMENT = 1');
        DB::statement('ALTER TABLE employee_details AUTO_INCREMENT = 1');
        // DB::statement('ALTER TABLE universal_search AUTO_INCREMENT = 1');

        $count = 5;

        $faker = \Faker\Factory::create();

            $user = new User();
            $user->name = $faker->name;
            $user->email = 'employee@example.com';
            $user->password = Hash::make('123456');
            $user->save();


            $employee = new EmployeeDetails();
            $employee->user_id = $user->id;
            $employee->employee_id = 'EMP-' . $user->id;
            $employee->address = $faker->address;
            $employee->department_id = $faker->numberBetween(1, 10);
            $employee->designation_id = $faker->numberBetween(1, 10);
            $employee->hourly_rate = $faker->numberBetween(15, 100);
            $employee->joining_date = now()->subMonths(9)->toDateTimeString();
            $employee->save();

            // Assign Role
            // $user->roles()->attach($employeeRole->id);

            // Multiple employee create
            User::factory((int)$count)->create()->each(function ($user) use ($faker) {

                $employee = new \App\Models\EmployeeDetails();
                $employee->user_id = $user->id; /* @phpstan-ignore-line */
                $employee->employee_id = 'EMP-' . $user->id; /* @phpstan-ignore-line */
                $employee->address = $faker->address;
                $employee->hourly_rate = $faker->numberBetween(15, 100);
                $employee->department_id = $faker->numberBetween(1, 10);
                $employee->designation_id = $faker->numberBetween(1, 10);
                $employee->hourly_rate = $faker->numberBetween(15, 100);
                $employee->joining_date = now()->subMonths(9)->toDateTimeString();
                $employee->save();

            });
    }
}
