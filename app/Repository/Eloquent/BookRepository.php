<?php

declare(strict_types=1);

namespace App\Repository\Eloquent;


use App\Repository\BookRepositoryInterface;
use Illuminate\Database\Eloquent\Collection;

class BookRepository extends BaseRepository implements BookRepositoryInterface
{

    /**
     * Get author of the book
     *
     * @return Collection
     */
    public function author(): Collection
    {
        // TODO: Implement author() method.
    }

    /**
     * Get the book readers
     *
     * @return Collection
     */
    public function readers(): Collection
    {
        // TODO: Implement readers() method.
    }
}
