<?php

namespace Database\Factories;

use App\Models\Employee;
use Illuminate\Database\Eloquent\Factories\Factory;

class EmployeeFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Employee::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {

        return [
            'firstName' => $this->faker->firstName,
            'lastName'=> $this->faker->lastName,
            'email' => $this->faker->unique()->safeEmail,
            'phone' => $this->faker->phoneNumber,
            'image' => $this->faker->imageUrl(),
            'address' => $this->faker->address,
            'salary' => $this->faker->numberBetween(),
            'sex'=> 'Man',
            "birthDate" => $this->faker->date(),
            'employee_categorie_id' => \App\Models\EmployeeCategorie::factory()->create(),
        ];
    }
}
