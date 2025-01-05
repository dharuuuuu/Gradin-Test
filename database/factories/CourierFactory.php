<?php

namespace Database\Factories;

use App\Models\Courier;
use Illuminate\Database\Eloquent\Factories\Factory;

class CourierFactory extends Factory
{
    protected $model = Courier::class;

    public function definition(): array
    {
        return [
            'name' => $this->faker->name,
            'email' => $this->faker->unique()->safeEmail,
            'phone' => $this->faker->phoneNumber,
            'level' => $this->faker->numberBetween(1, 5),
            'created_at' => $this->faker->dateTimeBetween('-1 year', 'now'), 
            'updated_at' => now(),
        ];
    }
}
