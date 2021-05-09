<?php

namespace Database\Factories;

use App\Models\Company;
use Illuminate\Database\Eloquent\Factories\Factory;

class CompanyFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Company::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'name' => $this->faker->name(),
            'domain' => strtolower($this->faker->unique()->firstName()) . '-tenancy.local',
            'bd_database' => strtolower($this->faker->unique()->firstName()) . '_tenancy',
            'bd_hostname' => 'localhost',
            'bd_username' => 'root',
            'bd_password' => '1@@LpjAdmin',
        ];
    }
}
