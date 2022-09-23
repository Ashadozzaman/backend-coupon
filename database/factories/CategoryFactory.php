<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;
class CategoryFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        $categories = ['Bangla','English','Math','Physics','Chemistry'];
        return [
            'name' => $categories[array_rand($categories, 1)].' '.Str::random(5),
        ];
    }
}
