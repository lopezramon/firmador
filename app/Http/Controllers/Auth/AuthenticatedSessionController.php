<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\AppBaseController;
use App\Http\Requests\Auth\LoginRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;

class AuthenticatedSessionController extends AppBaseController
{
    /**
     * Handle an incoming authentication request.
     *
     * @param  \App\Http\Requests\Auth\LoginRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(LoginRequest $request)
    {

        $request->authenticate();

        $user = Auth::user();

        $token = $user->createToken('Token')->plainTextToken;
        return $this->sendResponse(['Usuario' => $user, 'Token' => $token], 'Acceso satisfactorio');
    }

    /**
     * Destroy an authenticated session.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function logout(Request $request)
    {
        Auth::guard('web')->logout();

        Auth::user()->tokens()->delete();

        return response()->json(['token' => 'Token Revocado']);
    }
}
