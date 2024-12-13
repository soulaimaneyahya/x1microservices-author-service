<?php

namespace App\Http\Controllers;

use App\Models\Author;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\JsonResponse;

class AuthorController extends Controller
{
    public function index(): JsonResponse
    {
        $authors = Author::all();

        return $this->successResponse($authors);
    }

    public function store(Request $request): JsonResponse
    {
        $rules = [
            'name' => 'required|max:255',
            'email' => 'required|email|unique:authors,email',
            'country' => 'required|max:255',
        ];

        $this->validate($request, $rules);

        $author = Author::create($request->only(array_keys($rules)));

        return $this->successResponse($author, Response::HTTP_CREATED);
    }

    public function show(string $authorId): JsonResponse
    {
        $author = Author::findOrFail($authorId);

        return $this->successResponse($author);
    }

    public function update(Request $request, $authorId): JsonResponse
    {
        $author = Author::findOrFail($authorId);

        $rules = [
            'name' => 'max:255',
            'email' => 'email|unique:authors,email,' . $author->email,
            'country' => 'max:255',
        ];

        $this->validate($request, $rules);

        $author->fill($request->only(array_keys($rules)));

        if ($author->isClean()) {
            return $this->errorResponse(
                'At least one value must change',
                Response::HTTP_UNPROCESSABLE_ENTITY
            );
        }

        $author->save();

        return $this->successResponse($author);
    }

    public function destroy($authorId): JsonResponse
    {
        $author = Author::findOrFail($authorId);

        if ($author instanceof Author) {
            $author->delete();
        }

        return $this->successResponse([
            'message' => 'Author deleted'
        ], Response::HTTP_NO_CONTENT);
    }
}
