<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\Book\StoreBookRequest;
use App\Http\Requests\Book\UpdateBookRequest;
use App\Http\Resources\BookResource;
use App\Models\Book;
use App\Repository\Eloquent\BookRepository;
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
     * @return Response
     */
    public function index(): Response
    {
        $books = $this->repository->all([], ['author', 'librarian']);
        if (!$books) {
            return response()->error('Book collection not found', Response::HTTP_NOT_FOUND);
        }

        return response()->success(BookResource::collection($books))->get();
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  StoreBookRequest  $request
     * @return Response
     */
    public function store(StoreBookRequest $request): Response
    {
        $books = $this->repository->create($request->all());
        if (!$books) {
            return response()->error('Unprocessable Entity', Response::HTTP_UNPROCESSABLE_ENTITY);
        }

        return response()->success(new BookResource($books))->get();
    }

    /**
     * Display the specified resource.
     *
     * @param  Book  $book
     * @return Response
     */
    public function show(Book $book): Response
    {
        if (!$book->exists()) {
            return response()->error('Book model not found', Response::HTTP_NOT_FOUND);
        }

        return response()->success(new BookResource($book))->get();
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  UpdateBookRequest  $request
     * @param  Book  $book
     * @return void
     */
    public function update(UpdateBookRequest $request, Book $book)
    {
        $book = $this->repository->update($book->getKey(), $request->all());

        return response()->success(new BookResource($book))->get();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  Book  $book
     * @return Response
     */
    public function destroy(Book $book): Response
    {
        $this->repository->deleteById($book->getKey());

        return response()->success('Book model successfully deleted')->get();
    }

    public function attachBookToUser(Book $book)
    {
        if (!$book->exists()) {
            return response()->error('Book model not found', Response::HTTP_NOT_FOUND);
        }

    }
}
