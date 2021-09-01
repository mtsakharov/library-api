<?php


namespace App\Repository;


use Illuminate\Database\Eloquent\Collection;

interface AuthorRepositoryInterface
{
    /**
     * Get collection of author books.
     *
     * @return Collection
     */
    public function books(): Collection;
}
