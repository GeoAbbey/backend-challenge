<?php

namespace App\Http\Controllers\Api\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Api\Auth\LoginRequest;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    protected $guard;

    public function __construct($guard = 'api')
    {
        $this->guard = $guard;
    }

    public function login(LoginRequest $request)
    {
        $credentials = ['email' => $request->email, 'password' => $request->password];
        if (! $token = auth()->guard($this->guard)->attempt($credentials)) {
            return $this->invalidCredentials();
        }
        $user = Auth::guard($this->guard)->user();

        $user->last_login = Carbon::now();
        $user->save();

        return $this->returnToken($token);
    }

    /**
     * @return \Illuminate\Http\JsonResponse
     */
    private function invalidCredentials()
    {
        return response()->json([
            'status' => 'error',
            'message' => 'email and or password does not exists'
        ], 401);
    }

    /**
     * @param $user
     * @param null $request
     * @return \Illuminate\Http\JsonResponse
     */
    protected function returnToken($token)
    {
        return response()->json([
            'access_token' => $token,
            'token_type' => 'Bearer',
            'expires_at' => auth($this->guard)->factory()->getTTL() * 60
        ]);
    }

    /**
     * @return \Illuminate\Http\JsonResponse
     */
    public function logout()
    {
        auth()->guard($this->guard)->logout();
        return response()->json(['message' => 'Successfully logged out']);
    }
}
