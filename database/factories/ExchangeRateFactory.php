<?php

namespace Database\Factories;

use App\Models\ExchangeRate;
use Illuminate\Database\Eloquent\Factories\Factory;

class ExchangeRateFactory extends Factory
{
    protected $model = ExchangeRate::class;

    public function definition()
    {
        return [
            'date' => $this->faker->dateTimeBetween('-1 month', 'now')->format('Y-m-d'),
            'currency_from' => $this->faker->randomElement(['USD', 'PKR', 'INR']),
            'currency_to' => $this->faker->randomElement(['USD', 'PKR', 'INR']),
            'rate' => $this->faker->randomFloat(4, 0, 100),
        ];
    }
}

