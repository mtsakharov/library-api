<?php

declare(strict_types=1);

namespace App\Repository\Eloquent;


use App\Models\Book;
use App\Repository\BookRepositoryInterface;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use JetBrains\PhpStorm\Pure;

class BookRepository extends BaseRepository implements BookRepositoryInterface
{
    /**
     * @var Book $book
     */
    protected Book $book;

    /**
     * @param Book $book
     */
    #[Pure] public function __construct(Book $book)
    {
        $this->book = $book;

        parent::__construct($book);
    }

    public function getBookFromLibrary(int $bookId, int $userId, string $to)
    {
        $book = $this->findById($bookId);

        return $book->readers()->attach([
            'user_id' => $userId,
            'from' => Carbon::now(),
            'returned' => 0,
            'to' => $to,
        ]);
    }

    public function returnBookToLibrary(int $bookId, int $userId)
    {
        $book = $this->findById($bookId);
    }
}
