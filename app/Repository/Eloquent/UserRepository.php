<?php
declare(strict_types=1);

namespace App\Repository\Eloquent;


use App\Models\User;
use App\Repository\UserRepositoryInterface;
use Illuminate\Support\Collection;

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
    public function __construct(User $user)
    {
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
