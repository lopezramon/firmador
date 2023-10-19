<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\AppBaseController;
use App\Http\Requests\Auth\LoginRequest;
use App\Models\User as ModelsUser;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Spatie\Permission\Models\Role;

class AuthenticatedSessionController extends AppBaseController
{
    public function usarname()
    {
        return 'username';
    }
    protected function credentials($data)
    {
        return [
            'samaccountname' => $data['username'],
            'password' =>  $data['password']
        ];
    }

    /**
     * Handle an incoming authentication request.
     *
     * @param  \App\Http\Requests\Auth\LoginRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(LoginRequest $request)
    {
        $credentials = $this->credentials($request->all());
        if (Auth::attempt($credentials)) {

            $token = $request->user()->createToken('token')->plainTextToken;
            $user = Auth::user();

            return $this->sendResponse(['usuario' => $user,'token' => $token], 'Acceso satisfactorio');

        }elseif (true) {

            $user = ModelsUser::where('email','=',$request->input('username'))->first();
            if (Hash::check($request->input('password'), $user->password)) {
                $token = $request->user()->createToken($request->username);
            }

            return $this->sendResponse(['Usuario' => $user,'Token' => $token], 'Acceso satisfactorio');
        }else{
            return $this->sendError('Usuario o Contraseña invalidos');
        }
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
