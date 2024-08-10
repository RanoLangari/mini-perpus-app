<?php

namespace Database\Factories;

use App\Models\bookCategory;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\bookCategory>
 */

class BookCategoryFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    protected $model = bookCategory::class;
    public function definition(): array
    {
        return [
            'category_name' => $this->faker->word,
        ];
    }
}
