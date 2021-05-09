<?php

namespace Database\Factories;

use App\Models\Company;
use Illuminate\Support\Str;
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
        $firstName = strtolower(Str::random(10));
        return [
            'name' => $this->faker->name(),
            'domain' => $firstName . '-tenancy.local',
            'bd_database' => $firstName . '_tenancy',
            'bd_hostname' => 'localhost',
            'bd_username' => 'root',
            'bd_password' => '1@@LpjAdmin',
        ];
    }
}
