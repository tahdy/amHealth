<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class DoctorFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            //
            'bio'=>$this->faker->sentence($nbWords = 6, $variableNbWords = true),
            'specialty'=>$this->faker->randomElement($array = array ('Consultant','Specialist','Junior','SAS','Locum')),
            'department_id'=>$this->faker->numberBetween($min = 1, $max = 5)
        ];
    }
}
