<?php

namespace Database\Factories;

use App\Models\Book;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Book>
 */
class BookFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    protected $model = Book::class;
    public function definition(): array
    {
        return [
            'judul' => $this->faker->sentence,
            'kategori_id' => $this->faker->numberBetween(1, 5),
            'deskripsi' => $this->faker->paragraph,
            'jumlah' => $this->faker->numberBetween(1, 100),
            'file_buku' => $this->faker->word . '.pdf',
            'cover_buku' => $this->faker->word . '.jpg',
            'user_id' => $this->faker->numberBetween(1, 10),
        ];
    }
}
