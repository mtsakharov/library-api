<?php

namespace Database\Factories;

use App\Models\Author;
use App\Models\Book;
use App\Models\Librarian;
use Illuminate\Database\Eloquent\Factories\Factory;

class BookFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Book::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition(): array
    {
        return [
            'title' => $this->faker->title,
            'cover' => $this->faker->imageUrl('', '', 'books'),
            'author_id' => Author::all()->random()->id,
            'librarian_id' => Librarian::all()->random()->id,
        ];
    }
}
