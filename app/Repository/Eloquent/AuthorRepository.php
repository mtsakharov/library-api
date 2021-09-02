<?php
declare(strict_types=1);

namespace App\Repository\Eloquent;


use App\Models\Author;
use App\Repository\AuthorRepositoryInterface;
use Illuminate\Database\Eloquent\Collection;
use JetBrains\PhpStorm\Pure;

class AuthorRepository extends BaseRepository implements AuthorRepositoryInterface
{
    /**
     * @var Author $author
     */
    protected Author $author;

    /**
     * @param Author $author
     */
    #[Pure] public function __construct(Author $author)
    {
        $this->author = $author;

        parent::__construct($author);
    }


    public function books(): Collection
    {
        // TODO: Implement books() method.
    }
}
