<?php
declare(strict_types=1);

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\Author\StoreAuthorRequest;
use App\Http\Requests\Author\UpdateAuthorRequest;
use App\Http\Resources\AuthorResource;
use App\Models\Author;
use App\Repository\Eloquent\AuthorRepository;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Response;

class AuthorController extends Controller
{
    /**
     * @var AuthorRepository $repository
     */
    protected AuthorRepository $repository;

    /**
     * AuthorController constructor.
     * @param  AuthorRepository  $repository
     */
    public function __construct(AuthorRepository $repository)
    {
        $this->repository = $repository;
    }

    /**
     * Display a listing of the resource.
     * @return Response
     */
    public function index(): Response
    {
        $authors = $this->repository->all([], ['books'])->forPage(1, 10);
        if (!$authors) {
            return response()->error('Author collection not found', Response::HTTP_NOT_FOUND);
        }

        return response()->success(AuthorResource::collection($authors))->get();
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  StoreAuthorRequest  $request
     * @return Response
     */
    public function store(StoreAuthorRequest $request): Response
    {
        $author = $this->repository->create($request->all());
        if (!$author->exists()) {
            return response()->error('Unprocessable Entity', Response::HTTP_UNPROCESSABLE_ENTITY);
        }

        return response()->success(new AuthorRepository($author))->get();
    }

    /**
     * Display the specified resource.
     *
     * @param  Author  $author
     * @return Response
     */
    public function show(Author $author): Response
    {
        if (!$author->exists()) {
            return response()->error('Model not found', Response::HTTP_NOT_FOUND);
        }

        return response()->success(new AuthorRepository($author));
    }


    /**
     * @param  UpdateAuthorRequest  $request
     * @param  Author  $author
     * @return JsonResponse
     */
    public function update(UpdateAuthorRequest $request, Author $author): JsonResponse
    {
        $author = $this->repository->update($author->getKey(), $request->all());

        return response()->success(new AuthorResource($author));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param Author $author
     * @return JsonResponse
     */
    public function destroy(Author $author): JsonResponse
    {
        $this->repository->deleteById($author->getKey());

        return response()->success('Author model successfully deleted');
    }
}
