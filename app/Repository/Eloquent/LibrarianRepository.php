<?php
declare(strict_types=1);

namespace App\Repository\Eloquent;


use App\Models\Librarian;
use App\Repository\LibrarianRepositoryInterface;
use JetBrains\PhpStorm\Pure;

class LibrarianRepository extends BaseRepository implements LibrarianRepositoryInterface
{
    /**
     * @var Librarian $librarian
     */
    protected Librarian $librarian;

    /**
     * @param Librarian $librarian
     */
    #[Pure] public function __construct(Librarian $librarian)
    {
        $this->librarian = $librarian;

        parent::__construct($librarian);
    }
}
