<?php
declare(strict_types=1);

namespace App\Repository\Eloquent;


use App\Repository\AuthorRepositoryInterface;
use Illuminate\Database\Eloquent\Collection;

class AuthorRepository extends BaseRepository implements AuthorRepositoryInterface
{
    /**
     * Get collection of author books.
     *
     * @return Collection
     */
    public function books(): Collection
    {

    }
}
