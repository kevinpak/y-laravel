<?php

namespace Database\Factories;

use App\Models\EmployeeCategorie;
use Illuminate\Database\Eloquent\Factories\Factory;

class EmployeeCategorieFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = EmployeeCategorie::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'name' => $this->faker->jobTitle,
            'description' => $this->faker->sentence,
            'status' => 2,
        ];
    }
}
