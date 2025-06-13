<?php
namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class CatFactory extends Factory
{
    protected $model = \App\Models\Cat::class;

    public function definition()
    {
        return [
            'name' => $this->faker->firstName,
            'ras' => $this->faker->randomElement(['Persian','Siamese','Maine Coon']),
            'age' => $this->faker->numberBetween(1,15),
            'description' => $this->faker->sentence,
            'photo' => null,
        ];
    }
}