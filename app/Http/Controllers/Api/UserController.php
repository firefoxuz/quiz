<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\UserResource;
use App\Models\ApiUser;
use App\Traits\ApiResponser;
use Illuminate\Http\Request;

/**
 *
 * @OA\Get(
 *     summary="Retrieve a current user credentials",
 *     path="/api/user",
 *     description="Retrieve a current user credentials",
 *     tags={"User"},
 *     security={{"sanctum":{}}},
 *     @OA\Response(
 *      response="200",
 *      description="Retrieved user credentials",
 *      @OA\JsonContent(
 *         @OA\Property(property="status", type="string", example="success"),
 *         @OA\Property(property="message", type="null", example="null"),
 *         @OA\Property(property="data", type="object",
 *              @OA\Property(property="id", type="integer", example="1"),
 *              @OA\Property(property="first_name", type="string", example="Jackson"),
 *              @OA\Property(property="last_name", type="string", example="Hills"),
 *              @OA\Property(property="phone", type="string", example="998979991122"),
 *              @OA\Property(property="photo", type="string|null", example="http://quiz.uz/photos/U7BP95sAzCiO3ApqLDq2TWV8cCXTAT7Rj2Ox6GLG.jpg"),
 *              @OA\Property(property="email", type="string", format="email" , example="jack@gmail.com"),
 *              @OA\Property(property="last_login", type="string", format="date" , example="2022-03-03 09:15:17"),
 *              @OA\Property(property="registered_at", type="string", format="date" , example="2022-03-01 09:15:17"),
 *         ),
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
 * ),
 * @OA\Put (
 *     summary="Update a current user credentials",
 *     path="/api/user",
 *     description="Update a current user credentials",
 *     tags={"User"},
 *     security={{"sanctum":{}}},
 *     @OA\RequestBody(
 *         required=true,
 *         description="pass user credentials",
 *         @OA\JsonContent(
 *             @OA\Property(property="email", type="string", format="email", example="admin@admin.com"),
 *             @OA\Property(property="first_name", type="string", example="Jackson"),
 *             @OA\Property(property="last_name", type="string", example="Hills"),
 *             @OA\Property(property="phone", type="string", example="998979991122"),
 *             @OA\Property(property="password", type="string", format="password", example="Password123"),
 *
 *     ),
 * ),
 *     @OA\Response(
 *      response="200",
 *      description="Retrieved user credentials",
 *      @OA\JsonContent(
 *         @OA\Property(property="status", type="string", example="success"),
 *         @OA\Property(property="message", type="null", example="null"),
 *         @OA\Property(property="data", type="object",
 *              @OA\Property(property="id", type="integer", example="1"),
 *              @OA\Property(property="first_name", type="string", example="Jackson"),
 *              @OA\Property(property="last_name", type="string", example="Hills"),
 *              @OA\Property(property="phone", type="string", example="998979991122"),
 *              @OA\Property(property="email", type="string", format="email" , example="jack@gmail.com"),
 *              @OA\Property(property="last_login", type="string", format="date" , example="2022-03-03 09:15:17"),
 *              @OA\Property(property="registered_at", type="string", format="date" , example="2022-03-01 09:15:17"),
 *         ),
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
 * ),
 */
class UserController extends Controller
{
    use ApiResponser;

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function index()
    {
        return $this->success((new UserResource(auth()->user()))->toArray(request()));
    }


    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function update(Request $request)
    {
        $validated = $request->validate([
            'first_name' => 'nullable|string|max:50',
            'last_name' => 'nullable|string|max:50',
            'phone' => 'nullable|string|max:15',
            'email' => 'nullable|string|email|unique:api_users,email',
            'password' => 'nullable|string|min:6',
        ]);

        if (isset($validated['password'])) {
            $validated['password'] = bcrypt($validated['password']);
        }

        ApiUser::where('id', auth()->user()->id)->update($validated);
        $user = ApiUser::where('id', auth()->user()->id)->first();
        return $this->success($user);
    }
}
