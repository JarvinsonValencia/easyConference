<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class MeetFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'title' => $this->faker->sentence(),
            'purpose' => $this->faker->text(),
            'date' => $this->faker->date(),
            'end_date' => $this->faker->date(),
            //'client_id' => rand(1,5)

        ];
    }
}
