<?php

namespace Tests\Feature;

use App\Models\Book;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Http\Response;
use Laravel\Sanctum\Sanctum;
use Tests\CreatesApplication;
use Tests\TestCase;

class BookControllerTest extends TestCase
{
    use CreatesApplication, RefreshDatabase;

    /**
     * Indicates whether the default seeder should run before each test.
     *
     * @var bool
     */
    protected bool $seed = true;

    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function test_get_all()
    {
        // Run the DatabaseSeeder...
        $this->seed();

        Sanctum::actingAs(
            User::factory()->create(),
        );

        $this->get('/api/books')
            ->assertStatus(Response::HTTP_OK)
            ->assertJson([
                'success' => true
            ]);
    }

    public function test_store()
    {
        Sanctum::actingAs(
            User::factory()->create(),
        );

        $book = Book::factory()->make();
        $this->json('POST', 'api/books', $book->toArray())
            ->assertStatus(Response::HTTP_OK);
    }

    public function test_show()
    {
        Sanctum::actingAs(
            User::factory()->create(),
        );

        $book = Book::factory()->create();
        $this->json('GET', 'api/books/' . $book->getKey())
            ->assertStatus(Response::HTTP_OK);
    }

    public function test_update()
    {
        Sanctum::actingAs(
            User::factory()->create(),
        );

        $book = Book::factory()->create();
        $response = $this->json('PATCH', 'api/books/'.$book->getKey(), [
            'cover' => $book->cover,
            'title' => 'Martin Eden',
            'author_id' => $book->author_id,
            'librarian_id' => $book->librarian_id,
        ])
            ->assertStatus(Response::HTTP_OK);

        $this->json('GET', 'api/books/' . $book->getKey())
            ->assertStatus(Response::HTTP_OK);
    }

    public function test_delete_successfully()
    {
        Sanctum::actingAs(
            User::factory()->create(),
        );

        $book = Book::factory()->create();
        $this->json('PATCH', 'api/books/update/'.$book->getKey(), $book->toArray())
            ->assertStatus(Response::HTTP_OK);


    }

    /**
     *
     */
    public function test_attach_book_to_user_successfully()
    {
        Sanctum::actingAs(
            User::factory()->create(),
        );

        $book = Book::factory()->create();


    }

    /**
     *
     */
    public function test_attach_book_to_user_with_exist_books()
    {

    }
}
