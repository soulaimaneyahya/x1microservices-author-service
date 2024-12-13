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

    public function show(string $authorId): JsonResponse
    {
        $author = Author::findOrFail($authorId);

        return $this->successResponse($author);
    }

    public function store(Request $request)
    {
        $rules = [
            'name' => 'required|max:255',
            'email' => 'required|email|unique:authors,email',
            'country' => 'required|max:255',
        ];

        $this->validate($request, $rules);

        $author = Author::create($request->validated());

        return $this->successResponse($author, Response::HTTP_CREATED);
    }

    public function update(Request $request, $author)
    {
        $author = Author::findOrFail($author);

        $rules = [
            'name' => 'max:255',
            'email' => 'email|unique:authors,email,' . $author->email,
            'country' => 'max:255',
        ];

        $this->validate($request, $rules);

        $author->fill($request->validated());

        if ($author->isClean()) {
            return $this->errorResponse(
                'At least one value must change',
                Response::HTTP_UNPROCESSABLE_ENTITY
            );
        }

        $author->save();

        return $this->successResponse($author);
    }

    public function destroy($author)
    {
        $author = Author::findOrFail($author);

        if ($author instanceof Author) {
            $author->delete();
        }

        return $this->successResponse($author);
    }
}
