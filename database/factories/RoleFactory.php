<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class RoleFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'name'                  => $this->faker->unique()->words(2,true),

            'description'           => $this->faker->text,

            'created_at'            => now(),
            'updated_at'            => now(),
        ];
    }
}
