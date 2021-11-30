<?php

namespace App\Http\Controllers;

use App\Models\BlacklistUser;
use App\Models\AuthorizedUser;
use Illuminate\Http\Request;
use Tymon\JWTAuth\Facades\JWTAuth;


class AdminController extends Controller
{
    public function login(Request $request)
    {
        if ($request->password == env('ADM_PASSWORD')) {
            $users = AuthorizedUser::all();
            return view('admin', compact('users'));
        }

        return response()->json(['message' => 'Unauthorized']);
    }

    public function logoutUser(int $id)
    {
        $user = AuthorizedUser::findOrFail($id);

        if (!$token = $user['token']) {
            return response()->json(['message' => 'Usuário não está logado.'], 200);
        }

        JWTAuth::manager()->invalidate(new \Tymon\JWTAuth\Token($token), $forceForever = false);

        $user->token = null;
        $user->save();

        return redirect('admin_login');
    }

    public function deleteUserPermanently(int $id)
    {
        $user = AuthorizedUser::findOrFail($id);
        $this->setEmailBlacklist($user['email']);
        $user->delete();

        return redirect('admin_login');
    }

    public function setEmailBlacklist(string $email)
    {
        $blacklistUser = new BlacklistUser();
        $blacklistUser->email = $email;
        $blacklistUser->save();
    }

    public function verifyEmailInBlacklist(string $email)
    {
        return BlacklistUser::where('email', '=', $email)->exists();
    }
}
