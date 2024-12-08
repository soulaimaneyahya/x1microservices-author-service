<?php

/**
 * Author: Soulaimane Yahya
 * Date: 2024-12-07
 */

namespace App\Traits;

use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\JsonResponse;

trait ApiResponser
{
    /**
     * Build success response
     * @param  string|array $data
     * @param  int $code
     * @return JsonResponse
     */
    public function successResponse(string|array $data, int $code = Response::HTTP_OK): JsonResponse
    {
        return new JsonResponse(['data' => $data], $code);
    }

    /**
     * Build error responses
     * @param  string|array $message
     * @param  int $code
     * @return JsonResponse
     */
    public function errorResponse(string|array $message, int $code): JsonResponse
    {
        return new JsonResponse(['error' => $message, 'code' => $code], $code);
    }
}
