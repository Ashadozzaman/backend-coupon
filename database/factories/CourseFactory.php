<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Faker\Generator as Faker;
use App\Models\Category;
class CourseFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        $category = Category::pluck('id')->toArray();
        return [
            'category_id'=>  $category[array_rand($category, 1)],
            'name' => $this->faker->name,
            'amount' => rand(000,111)

        ];

    }
}
