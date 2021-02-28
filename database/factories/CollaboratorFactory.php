<?php

namespace Database\Factories;

use App\AsientoContable\Collaborators\Collaborator;
use App\AsientoContable\Customers\Customer;
use Illuminate\Database\Eloquent\Factories\Factory;

class CollaboratorFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Collaborator::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'code' => $this->faker->unique()->randomNumber(5),
            'nro_document' => $this->faker->randomNumber(8),
            'full_name' => $this->faker->name(),
            /*'work_area_id' => $this->faker->randomNumber(2),
            'work_area' => $this->faker->jobTitle,*/
           // 'position' => 'Web',
            'date_start_work' => $this->faker->dateTimeBetween('2021-01-01'),
            'customer_id' => $this->faker->randomElement(Customer::all()->pluck('id')->toArray()),

        ];
    }
}
