<?php


namespace App\Repository;


use Illuminate\Database\Eloquent\Collection;

interface BookRepositoryInterface
{
    /**
     * Get author of the book
     *
     * @return Collection
     */
    public function author(): Collection;

    /**
     * Get the book readers
     *
     * @return Collection
     */
    public function readers(): Collection;
}
