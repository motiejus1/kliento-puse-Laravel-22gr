<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class CompanyFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {

        $test_data = ['Profit-focused foreground neural-net','Virtual foreground opensystem','Balanced stable attitude'];
        return [
            'title' => $test_data[rand(0,2)]
        ];
    }
}
