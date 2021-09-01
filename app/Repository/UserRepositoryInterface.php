<?php
declare(strict_types=1);

namespace App\Repository;


use Illuminate\Support\Collection;

interface UserRepositoryInterface
{
    /**
     * Get collection of author books.
     *
     * @return Collection
     */
    public function books(): Collection;
}
