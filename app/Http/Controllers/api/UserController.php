<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use App\Http\Requests\UserRequest;
use App\Jobs\MailerJob;
use App\Repositories\UserRepository;

class UserController extends Controller
{
    protected $user;

    public function __construct(UserRepository $user)
    {
        $this->user = $user;
    }

    public function login(UserRequest $request)
    {
        try {
            $data = $this->user->login($request);
            $user = $data['user'];

            if (!$user->email_verified_at) {
                $user->tokens()->delete();

                dispatch(new MailerJob($user, 'validate'));

                return response()->json(encrypt(json_encode([
                    'status' => false,
                    'message' => 'Email belum terverifikasi! Silahkan cek email anda!',
                    'data' => null
                ])), 400);
            }

            return response()->json(encrypt(json_encode([
                'status' => true,
                'message' => 'Login berhasil!',
                'data' => $data
            ])), 200);
        } catch (\Throwable $th) {
            return response()->json(encrypt(json_encode([
                'status' => false,
                'message' => $th->getMessage(),
                'data' => null
            ])), 400);
        }
    }

    public function register(UserRequest $request)
    {
        try {
            $data = $this->user->register($request);

            dispatch(new MailerJob($data, 'validate'));

            return response()->json(encrypt(json_encode([
                'status' => true,
                'message' => 'Registrasi berhasil!',
                'data' => $data
            ])), 200);
        } catch (\Throwable $th) {
            return response()->json(encrypt(json_encode([
                'status' => false,
                'message' => $th->getMessage(),
                'data' => null
            ])), 400);
        }
    }

    public function logout(UserRequest $request)
    {
        try {
            $data = $this->user->logout($request);

            return response()->json(encrypt(json_encode([
                'status' => true,
                'message' => 'Logout berhasil!',
                'data' => $data
            ])), 200);
        } catch (\Throwable $th) {
            return response()->json(encrypt(json_encode([
                'status' => false,
                'message' => $th->getMessage(),
                'data' => null
            ])), 400);
        }
    }
}
