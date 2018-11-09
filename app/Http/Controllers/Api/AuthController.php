<?php

namespace App\Http\Controllers\Api;

use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class AuthController extends Controller
{
    use AuthenticatesUsers;

    public function login(Request $request)
    {
        //valida login
        $this->validateLogin($request);

        //retorna crediciais
        $credentials = $this->credentials($request);

        //pega token
        $token = \JWTAuth::attempt($credentials);

        return $this->responseToken($token);
    }

    private function responseToken($token)
    {
        return $token ? ['token' => $token] : response()->json([
           'error' => \Lang::get('auth.failed')
        ], 400);
    }

    public function logout()
    {
        \Auth::guard('api')->logout();

        // 204 No-content
        return response()->json([], 204);
    }

    public function refresh()
    {
        $token = \Auth::guard('api')->refresh();
        return ['token' => $token];
    }
}
