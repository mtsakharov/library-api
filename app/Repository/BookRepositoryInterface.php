<?php


namespace App\Repository;


use Illuminate\Database\Eloquent\Model;

interface BookRepositoryInterface
{
    public function getBookFromLibrary(int $bookId, int $userId, string $to);

    public function returnBookToLibrary(int $bookId, int $userId);
}
