<?php

namespace App\Http\Controllers\Api\Auth;

use App\Http\Controllers\Api\BaseController;
use App\Models\ApiUser;
use App\Traits\ApiResponser;
use Carbon\Carbon;
use Illuminate\Http\Request;
/**
 * @OA\Post(
 *     summary="Register a new user",
 *     path="/api/register",
 *     description="Register a new user",
 *     tags={"Auth"},
 *     @OA\Response(response="200", description="Register user")
 * )
 */

class RegisterController extends BaseController
{
    use ApiResponser;

    public function register(Request $request)
    {
        $attr = $request->validate([
            'first_name' => 'required|string|max:50',
            'last_name' => 'nullable|string|max:50',
            'email' => 'required|string|email|unique:api_users,email',
            'password' => 'required|string|min:6',
            'phone' => 'nullable|max:15|min:10',
        ]);

        $user = ApiUser::create([
            'first_name' => $attr['first_name'] ?? null,
            'last_name' => $attr['last_name'] ?? null,
            'password' => bcrypt($attr['password']),
            'email' => $attr['email'] ,
            'phone' => $attr['phone'] ?? null,
            'registered_at' => Carbon::now()->toDateTimeString(),
        ]);

        return $this->success([
            'token' => $user->createToken('API Token')->plainTextToken
        ]);
    }
}