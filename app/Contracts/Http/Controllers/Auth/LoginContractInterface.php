<?php
declare(strict_types=1);

namespace App\Contracts\Http\Controllers\Auth;


use App\Http\Requests\Auth\LoginRequest;
use App\Http\Resources\UserResource;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

interface LoginContractInterface
{
    /**
     * @return Response
     */
    public function login(LoginRequest $request): JsonResponse;

    /**
     * @param  Request  $request
     * @return UserResource
     */
    public function getRequestUser(Request $request): JsonResponse;

    /**
     * @param  Request  $request
     * @return Response
     */
    public function logout(Request $request): JsonResponse;
}
