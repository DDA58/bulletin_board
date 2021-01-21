<?php

namespace Database\Factories;

use App\Models\Adverts;
use Illuminate\Database\Eloquent\Factories\Factory;

class AdvertsFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Adverts::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'category_id' => rand(1, 21),
            'user_id' => rand(1, 5),
            'city_id' => rand(1, 3605),
            'title' => $this->faker->text(50),
            'description' => $this->faker->text(500),
            'status' => 0,
            'cost' => rand(100, 50000),
            'publish_date' => $this->faker->dateTimeBetween('-30 day', 'now'),
            'views_amount' => rand(0, 100),
            'photos' => null
        ];
    }
}