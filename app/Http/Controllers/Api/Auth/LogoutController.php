<?php

namespace App\Http\Controllers\Api\Auth;

use App\Http\Controllers\Api\BaseController;

/**
 *   @OAS\SecurityScheme(
 *      securityScheme="bearer_token",
 *      type="http",
 *      scheme="bearer"
 * ),
 * @OA\Post(
 *     summary="Logout a user",
 *     path="/api/logout",
 *      security={{"sanctum":{}}},
 *     description="Logout a user",
 *     tags={"Auth"},
 *     @OA\Response(
 *      response="200",
 *      description="User logged out successfully",
 *      @OA\JsonContent(
 *         @OA\Property(property="message", type="string", example="Tokens Revoked"),
 *      ),
 *     ),
 *     @OA\Response(
 *      response="401",
 *      description="Unauthenticated a user",
 *      @OA\JsonContent(
*           @OA\Property(property="message", type="string", example="Unauthenticated"),
 *         ),
 *      ),
 *     ),
 * )
 */

class LogoutController extends BaseController
{

    /**
     * Log the user out (Invalidate the token).
     *
     * @return string[]
     */
    public function logout()
    {
        auth()->user()->tokens()->delete();

        return [
            'message' => 'Tokens Revoked'
        ];
    }
}