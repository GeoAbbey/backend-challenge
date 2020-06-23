<?php

namespace App\Http\Controllers\Api\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Api\Auth\LoginRequest;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    public function login(LoginRequest $request)
    {
        $credentials = ['email' => $request->email, 'password' => $request->password];
        if(!Auth::attempt($credentials)) {
            return $this->invalidCredentials();
        }
        $user = $request->user();

        $user->last_login = Carbon::now();
        $user->save();

        return $this->returnToken($user, $request);
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
    protected function returnToken($user, $request = null)
    {
        $tokenResult = $user->createToken('Personal Access Token');
        $token = $tokenResult->token;
        if ($request && $request->remember_me) {
            $token->expires_at = Carbon::now()->addWeeks(1);
        }
        $token->save();
        return response()->json([
            'access_token' => $tokenResult->accessToken,
            'token_type' => 'Bearer',
            'expires_at' => Carbon::parse(
                $tokenResult->token->expires_at
            )->toDateTimeString()
        ]);
    }
}
