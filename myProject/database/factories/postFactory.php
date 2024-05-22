<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Faker\Factory as Faker;
/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\post>
 */
class postFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        $faker=Faker::Create();
        return [
            'user_id'=>31,
            'post_category_id'=>$faker->numberBetween(2,4),
            'post_name'=>$faker->name,
            'post_desc'=>$faker->paragraph(),
            'post_image'=>$faker->imageUrl(),
        ];
    }
}
