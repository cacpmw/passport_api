<?php

namespace App\Repositories\V1;
use App\Http\Requests\Api\V1\Auth\Login\LoginRequest;
use App\User;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class AuthRepository
{
    public function login(Array $credentials, LoginRequest $r)
    {

        if (!Auth::attempt($credentials)) {
            return response()->json(['message' => 'Unauthorized'], Response::HTTP_UNAUTHORIZED);
        }
        $tokenResult = $r->user()->createToken($r->user()->name . ' Personal Access Token', ['self']);
        $token = $tokenResult->token;
        $token->save();
        return response()->json(
            [
                'accessToken' => $tokenResult->accessToken,
                'token_type' => 'Bearer',
                'expires_at' => Carbon::parse($token->expires_at)->toDateString(),
                'scopes' => $token->scopes
            ],
            Response::HTTP_OK
        );
    }

    public function logout()
    {
        Auth::user()->token()->revoke();
        return response()->json([], Response::HTTP_NO_CONTENT);
    }

    public function register($data)
    {
        $newUser = User::create([
            'name' => $data['name'],
            'email' => $data['email'],
            'password' => bcrypt($data['password']),
            'role_id' => $data['role_id']
        ]);
        return response()->json($newUser, Response::HTTP_CREATED);
    }
}
