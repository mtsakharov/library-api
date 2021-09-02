<?php
declare(strict_types=1);

namespace App\Repository\Eloquent;


use App\Models\User;
use App\Repository\UserRepositoryInterface;
use Illuminate\Support\Collection;
use JetBrains\PhpStorm\Pure;

class UserRepository extends BaseRepository implements UserRepositoryInterface
{
    /**
     * @var User $user
     */
    protected User $user;

    /**
     * UserRepository constructor.
     * @param  User  $user
     */
    #[Pure] public function __construct(User $user)
    {
        $this->user = $user;

        parent::__construct($user);
    }

    /**
     * Get collection of author books.
     *
     * @return Collection
     */
    public function books(): Collection
    {
        // TODO: Implement books() method.
    }
}
