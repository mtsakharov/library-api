<?php
declare(strict_types=1);

namespace App\Http\Controllers\Api\Auth;


use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\RegisterRequest;
use App\Http\Resources\UserResource;
use App\Repository\Eloquent\UserRepository;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Http\Response;

class RegisterController extends Controller
{
    /**
     * @var UserRepository $repository
     */
    protected UserRepository $repository;

    /**
     * RegisterController constructor.
     * @param  UserRepository  $repository
     */
    public function __construct(UserRepository $repository)
    {
        $this->repository = $repository;
    }

    /**
     * @param  RegisterRequest  $request
     * @return JsonResponse
     */
    public function register(RegisterRequest $request): JsonResponse
    {
        $user = $this->repository->create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => bcrypt($request->password)
        ]);
        if (!$user) {
            return response()->error('Model not found', Response::HTTP_NOT_FOUND);
        }

        return response()->success([new UserResource($user)]);
    }
}
