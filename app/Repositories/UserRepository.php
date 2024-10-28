<?php

namespace App\Repositories;

use App\Models\User;
use Illuminate\Support\Facades\Auth;

class UserRepository
{
    protected $user;

    public function __construct(User $user)
    {
        $this->user = $user;
    }

    public function login($request)
    {
        $credentials = $request->only('email', 'password');

        if (!Auth::attempt($credentials)) {
            throw new \Exception('Login Gagal!');
        }

        $user = $this->user->where('email', $credentials['email'])->first();

        $token = $user->createToken('authToken')->plainTextToken;

        return [
            'user' => $user,
            'token' => $token,
        ];
    }

    public function register($request)
    {
        $credentials = $request->only('email', 'password', 'name');
        $user = $this->user->create([
            'name' => $credentials['name'],
            'email' => $credentials['email'],
            'password' => bcrypt($credentials['password'], [
                'rounds' => 12,
            ]),
        ]);

        return $user;
    }

    public function logout($request)
    {
        return $request->user()->currentAccessToken()->delete();;
    }
}