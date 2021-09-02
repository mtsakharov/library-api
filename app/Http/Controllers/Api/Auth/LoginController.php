<?php
declare(strict_types=1);

namespace App\Http\Controllers\Api\Auth;

use App\Contracts\Http\Controllers\Auth\LoginContractInterface;
use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\LoginRequest;
use App\Http\Resources\UserResource;
use App\Repository\Eloquent\UserRepository;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class LoginController extends Controller implements LoginContractInterface
{
    /**
     * @var UserRepository $repository
     */
    protected UserRepository $repository;

    /**
     * LoginController constructor.
     * @param  UserRepository  $repository
     */
    public function __construct(UserRepository $repository)
    {
        $this->repository = $repository;
    }

    /**
     * @param  LoginRequest  $request
     * @return JsonResponse
     */
    public function login(LoginRequest $request): JsonResponse
    {
        // Find the user
        $user = $this->repository->findByColumn('email', '=', $request->post('email'));
        if (!$user) {
            return response()->error('Model not found', Response::HTTP_NOT_FOUND);
        }

        // Check credentials
        if (!auth()->attempt($request->only('email', 'password'))) {
            return response()->error('Model not found', Response::HTTP_NOT_FOUND);
        }

        // Create token and return response
        $token = $user->createToken('auth_token')->plainTextToken;
        return response()->success(['token' => $token]);
    }

    /**
     * @param Request $request
     * @return JsonResponse
     */
    public function getRequestUser(Request $request): JsonResponse
    {
        return new UserResource($request->user());
    }

    /**
     * @param Request $request
     * @return JsonResponse
     */
    public function logout(Request $request): JsonResponse
    {
        // Revoke the token that was used to authenticate the current request...
        $request->user()->currentAccessToken()->delete();

        return response()->success()->get();
    }
}
