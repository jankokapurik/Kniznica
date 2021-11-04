<?php

namespace Database\Factories;

use App\Models\Knihy;
use Illuminate\Database\Eloquent\Factories\Factory;

class KnihyFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Knihy::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'body' => $this->faker->sentence(20),
        ];
    }
}
