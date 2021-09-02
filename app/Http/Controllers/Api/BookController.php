<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\Book\AttachUserToBookRequest;
use App\Http\Requests\Book\StoreBookRequest;
use App\Http\Requests\Book\UpdateBookRequest;
use App\Http\Resources\BookResource;
use App\Models\Book;
use App\Repository\Eloquent\BookRepository;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Response;

class BookController extends Controller
{
    /**
     * @var BookRepository $repository
     */
    protected BookRepository $repository;

    /**
     * BookController constructor.
     * @param  BookRepository  $repository
     */
    public function __construct(BookRepository $repository)
    {
        $this->repository = $repository;
    }

    /**
     * Display a listing of the resource.
     *
     * @return JsonResponse
     */
    public function index(): JsonResponse
    {
        $books = $this->repository->all()->forPage(1, 10);
        if (!$books) {
            return response()->error('Book collection not found', Response::HTTP_NOT_FOUND);
        }

        return response()->success(BookResource::collection($books));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param StoreBookRequest $request
     * @return JsonResponse
     */
    public function store(StoreBookRequest $request): JsonResponse
    {
        $books = $this->repository->create($request->all());
        if (!$books) {
            return response()->error('Unprocessable Entity', Response::HTTP_UNPROCESSABLE_ENTITY);
        }

        return response()->success(new BookResource($books));
    }

    /**
     * Display the specified resource.
     *
     * @param Book $book
     * @return JsonResponse
     */
    public function show(Book $book): JsonResponse
    {
        if (!$book->exists()) {
            return response()->error('Book model not found', Response::HTTP_NOT_FOUND);
        }

        return response()->success(new BookResource($book));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param UpdateBookRequest $request
     * @param Book $book
     * @return JsonResponse
     */
    public function update(UpdateBookRequest $request, Book $book): JsonResponse
    {
        $this->repository->update($book->getKey(), $request->all());

        return response()->success('model successfully updated');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param Book $book
     * @return JsonResponse
     */
    public function destroy(Book $book): JsonResponse
    {
        $this->repository->deleteById($book->getKey());

        return response()->success('Book model successfully deleted');
    }

    /**
     * @param AttachUserToBookRequest $request
     * @param Book $book
     * @return void
     */
    public function getBookFromLibrarian(AttachUserToBookRequest $request, Book $book)
    {
        if (!$book->exists()) {
            return response()->error('Book model not found', Response::HTTP_NOT_FOUND);
        }

        if ($request->user()->notReturnedBooks()) {
            return response()->error('Access denied', Response::HTTP_METHOD_NOT_ALLOWED);
        }

        $this->repository->attachReaderToBook($book->getKey(), $request->user()->id, $request->to);

        return response()->success('Book model successfully attached');
    }

    public function returnBookToLibrary(AttachUserToBookRequest $request, Book $book)
    {
        if (!$book->exists()) {
            return response()->error('Book model not found', Response::HTTP_NOT_FOUND);
        }


        return response()->success('Book model successfully attached');
    }
}
