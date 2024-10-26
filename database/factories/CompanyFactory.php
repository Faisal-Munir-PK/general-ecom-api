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
            'title' => $this->faker->company(),
            'slogan' => $this->faker->text(),
            'description' => $this->faker->sentence(),
            'about' => $this->faker->sentence(20),
            'primary_email' => $this->faker->unique()->safeEmail(),
            'secondary_email' => $this->faker->unique()->safeEmail(),
            'website' => 'www.example.com',
            'phone' => $this->faker->phoneNumber(),
            'is_active' => true
        ];
    }
}
