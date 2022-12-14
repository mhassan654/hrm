<?php

namespace Database\Factories;

use Carbon\Carbon;
use App\Models\User;
use App\Models\LeaveType;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Model>
 */
class LeaveFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Leave::class;
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        $employees = User::allEmployees()->pluck('id')->toArray();
        $leaveType = LeaveType::all()->pluck('id')->toArray();

        return [
            'user_id' => $this->faker->randomElement($employees),
            'leave_type_id' => $this->faker->randomElement($leaveType),
            'duration' => $this->faker->randomElement(['single']),
            'leave_date' => Carbon::parse($this->faker->numberBetween(1, now()->month) . '/' . $this->faker->numberBetween(1, now()->day) . '/' . now()->year)->format('Y-m-d'),
            'reason' => $this->faker->realText(200),
            'status' => $this->faker->randomElement(['pending', 'approved', 'rejected']),
        ];
    }
}
