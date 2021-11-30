<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Http\Controllers\AdminController;
use App\Models\AuthorizedUser;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;


class AuthController extends Controller
{

    /**
     * @OA\Post(
     *     tags={"Auth"},
     *     path="/api/register",
     *     description="Registra suas credenciais na base, para posteriormente ser feito login e obter o token.",
     *     @OA\Response(
     *         response=201,
     *         description="Account created",
     *     ),
     *     @OA\Response(
     *         response=422,
     *         description="Unprocessable Entity",
     *     ),
     *     @OA\Parameter(
     *     name="Body",
     *     in="query",
     *     description="",
     *     required=true,
     *     @OA\Schema(
     *          type="object",
     *          @OA\Property(property="name", type="string", example="Joao"),
     *          @OA\Property(property="email", type="string", example="joao@gmail.com"),
     *          @OA\Property(property="password", type="string", example="12345"),
     *          @OA\Property(property="password_confirmation", type="string", example="12345"),
     *     ),
     *   )
     * )
     */
    public function register(Request $request)
    {
        $this->validate($request, [
            'name' => 'required|string',
            'email' => 'required|email|unique:authorized_users',
            'password' => 'required|confirmed',
        ]);

        $Blacklist = new AdminController();
        if ($Blacklist->verifyEmailInBlacklist($request->email)) {
            return response()->json(["message" => "This user is blacklisted."], 401);
        }

        try {
            $user = new AuthorizedUser();
            $user->name = $request->name;
            $user->email = $request->email;
            $plainPassword = $request->password;
            $user->password = app('hash')->make($plainPassword);
            $user->save();

            return response()->json(['user' => $user, 'message' => 'CREATED'], 201);
        } catch (\Exception $e) {
            return response()->json(['message' => 'User Registration Failed!'], 409);
        }
    }


    /**
     * @OA\Post(
     *     tags={"Auth"},
     *     path="/api/login",
     *     description="Rota utilizada para obter o token de acesso.",
     *     @OA\Response(
     *         response=200,
     *         description="Token generated",
     *     ),
     *     @OA\Response(
     *         response=401,
     *         description="Incorrect credentials",
     *     ),
     *     @OA\Parameter(
     *     name="Body",
     *     in="query",
     *     description="",
     *     required=true,
     *     @OA\Schema(
     *          type="object",
     *          @OA\Property(property="email", type="string", example="joao@gmail.com"),
     *          @OA\Property(property="password", type="string", example="12345"),
     *     ),
     *   )
     * )
     */

    /**
     * Get a JWT via given credentials.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function login()
    {
        $credentials = request(['email', 'password']);

        if (!$token = Auth::attempt($credentials)) {
            return response()->json(['error' => 'Incorrect credentials'], 401);
        }

        $user = AuthorizedUser::where('email', $credentials['email'])->first();
        $user->token = $token;
        $user->save();

        return $this->respondWithToken($token);
    }

    /**
     * Get the authenticated User.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function me()
    {
        return response()->json(auth()->user());
    }


    /**
     * @OA\Get(
     *     tags={"Auth"},
     *     path="/api/logout",
     *     description="Faz logout, revogando o token atual.",
     *     security={{"bearerAuth": {}}},
     *     @OA\Response(
     *         response=200,
     *         description="Token revoked",
     *     ),
     *     @OA\Response(
     *         response=401,
     *         description="Unauthorized",
     *     ),
     * )
     */
    /**
     * Log the user out (Invalidate the token).
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function logout()
    {
        Auth::logout();

        return response()->json(['message' => 'Successfully logged out']);
    }

    /**
     * Refresh a token.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function refresh()
    {
        return $this->respondWithToken(Auth::refresh());
    }

    /**
     * Get the token array structure.
     *
     * @param  string $token
     *
     * @return \Illuminate\Http\JsonResponse
     */
    protected function respondWithToken($token)
    {
        return response()->json([
            'access_token' => $token,
            'token_type' => 'bearer',
            'expires_in' => Auth::factory()->getTTL() * 60
        ]);
    }
}
