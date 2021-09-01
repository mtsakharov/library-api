<?php
declare(strict_types=1);

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\User\StoreUserRequest;
use App\Http\Requests\User\UpdateUserRequest;
use App\Http\Resources\UserResource;
use App\Models\User;
use App\Repository\Eloquent\UserRepository;
use Illuminate\Http\Response;

class UserController extends Controller
{
    /**
     * @var UserRepository $repository
     */
    protected UserRepository $repository;

    /**
     * UserController constructor.
     * @param  UserRepository  $repository
     */
    public function __construct(UserRepository $repository)
    {
        $this->repository = $repository;
    }

    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index(): Response
    {
        $users = $this->repository->all([], ['books'])->forPage(1, 10);
        if (!$users) {
            return response()->error('User collection not found', Response::HTTP_NOT_FOUND);
        }

        return response()->success(UserResource::collection($users))->get();
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  StoreUserRequest  $request
     * @return Response
     */
    public function store(StoreUserRequest $request): Response
    {
        $user = $this->repository->create($request->all());
        if (!$user){
            return response()->error('User collection not found', Response::HTTP_NOT_FOUND);
        }

        return response()->success(new UserResource($user))->get();
    }

    /**
     * Display the specified resource.
     *
     * @param  User  $user
     * @return Response
     */
    public function show(User $user): Response
    {
        if (!$user) {
            return response()->error('User model not found', Response::HTTP_NOT_FOUND);
        }

        return response()->success(new UserResource($user))->get();
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  UpdateUserRequest  $request
     * @param  User  $user
     * @return Response
     */
    public function update(UpdateUserRequest $request, User $user): Response
    {
        $user = $this->repository->update($user->getKey(), $request->all());
        if (!$user) {
            return response()->error('User model not found', Response::HTTP_NOT_FOUND);

        }

        return response()->success(new UserRepository($user))->get();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  User  $user
     * @return Response
     */
    public function destroy(User $user): Response
    {
        $this->repository->deleteById($user->getKey());

        return response()->success('Librarian model successfully deleted')->get();
    }
}
