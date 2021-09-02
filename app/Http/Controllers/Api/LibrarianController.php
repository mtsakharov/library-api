<?php
declare(strict_types=1);

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\Book\UpdateBookRequest;
use App\Http\Requests\Librarian\StoreLibrarianRequest;
use App\Http\Resources\LibrarianResource;
use App\Models\Librarian;
use App\Repository\Eloquent\LibrarianRepository;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Response;

class LibrarianController extends Controller
{
    /**
     * @var LibrarianRepository $repository
     */
    protected LibrarianRepository $repository;

    /**
     * LibrarianController constructor.
     * @param  LibrarianRepository  $repository
     */
    public function __construct(LibrarianRepository $repository)
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
        $librarians = $this->repository->all([], ['books'])->forPage(1, 10);
        if (!$librarians) {
            return response()->error('Book collection not found', Response::HTTP_NOT_FOUND);
        }

        return response()->success(LibrarianResource::collection($librarians));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param StoreLibrarianRequest $request
     * @return JsonResponse
     */
    public function store(StoreLibrarianRequest $request): JsonResponse
    {
        $librarian = $this->repository->create($request->all());
        if (!$librarian) {
            return response()->error('Unprocessable Entity', Response::HTTP_UNPROCESSABLE_ENTITY);
        }

        return response()->success(new LibrarianResource($librarian));
    }

    /**
     * Display the specified resource.
     *
     * @param  Librarian  $librarian
     * @return Response
     */
    public function show(Librarian $librarian): JsonResponse
    {
        if (!$librarian->exists()) {
            return response()->error('Book model not found', Response::HTTP_NOT_FOUND);
        }

        return response()->success(new LibrarianResource($librarian));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param UpdateBookRequest $request
     * @param Librarian $librarian
     * @return JsonResponse
     */
    public function update(UpdateBookRequest $request, Librarian $librarian): JsonResponse
    {
        $librarian = $this->repository->update($librarian->getKey(), $request->all());

        return response()->success(new LibrarianResource($librarian));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param Librarian $librarian
     * @return JsonResponse
     */
    public function destroy(Librarian $librarian): JsonResponse
    {
        $this->repository->deleteById($librarian->getKey());

        return response()->success('Librarian model successfully deleted');
    }

    private function isLibrarianWorkDay(Librarian $librarian)
    {

    }
}
