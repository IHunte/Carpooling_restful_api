<?php

namespace Database\Factories;

use App\Models\Voyage;
use Illuminate\Database\Eloquent\Factories\Factory;

class VoyageFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Voyage::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'start' => $this->faker->city(),
            'destination' => $this->faker->city(),
            'date' => $this->faker->date(),
            'time' => $this->faker->time(),
            'car_model' => $this->faker->name(),
            'num_passengers' => $this->faker->numberBetween(0, 4),
            'cotisation' => $this->faker->randomFloat(0.5, 40),
            'description' => $this->faker->paragraph(3, true)
        ];
    }
}
