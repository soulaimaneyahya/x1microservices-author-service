<?php

namespace App\Http\Controllers;

use App\Models\Author;
use App\Http\Controllers\Controller;
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
}
