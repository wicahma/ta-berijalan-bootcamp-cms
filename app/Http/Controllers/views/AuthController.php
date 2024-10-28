<?php

namespace App\Http\Controllers\views;

use App\Http\Controllers\Controller;
use GuzzleHttp\Client;
use GuzzleHttp\Exception\RequestException;
use Illuminate\Http\Request;

class AuthController extends Controller
{
    protected $client;
    public function __construct()
    {
        $this->client = new Client();
    }

    public function login(Request $request)
    {
        return view('pages.login.index', ['email_verified' => $request->query('email_verified')]);
    }

    public function register()
    {
        return view('pages.register.index');
    }

    public function forgotPassword()
    {
        return view('pages.forgot_password.index');
    }


    public function reqLogout()
    {
        $token = session()->get('LoginSession');
        $this->client->post(config('app.api_url') . '/auth/logout', [
            'headers' => [
                'Accept' => 'application/json',
                'Content-Type' => 'application/json',
                'Authorization' => 'Bearer ' . $token
            ],
        ]);
        session()->flush();
        return redirect()->route('page.auth.login');
    }

    public function reqLogin(Request $req)
    {
        try {
            $response = $this->client->post(config('app.api_url') . '/auth/login', [
                'headers' => [
                    'Accept' => 'application/json',
                    'Content-Type' => 'application/json'
                ],
                'body' => json_encode([
                    "email" => $req->email,
                    "password" => $req->password
                ])
            ]);

            $jsonResponse = json_decode(decrypt($response->getBody()->getContents()));
            $res = [];
            if ($jsonResponse->status) {
                $req->session()->put('LoginSession', $jsonResponse->data->token);
                // $req->session()->put('UserId', $jsonResponse->data->user->id);
                $req->session()->put('UserName', $jsonResponse->data->user->name);
                $req->session()->put('UserEmail', $jsonResponse->data->user->email);

                $res = [
                    'type' => 'success',
                    'message' => 'Berhasil login!',
                ];
                return redirect()->route('page.dashboard.index')->with($res);
            } else {
                $res = [
                    'type' => 'error',
                    'message' => 'Gagal login, username atau password salah!',
                ];
                return redirect()->route('page.auth.login')->with($res);
            }
        } catch (RequestException $th) {
            $decrypted = json_decode(decrypt($th->getResponse()->getBody()->getContents()));
            $res = [
                'type' => 'error',
                'message' => $decrypted->message ?? 'Terjadi kesalahan!',
            ];
            return redirect(route('page.auth.login'))->with($res);
        }
    }

    public function reqRegister(Request $req)
    {
        try {
            $response = $this->client->post(config('app.api_url') . '/auth/register', [
                'headers' => [
                    'Accept' => 'application/json',
                    'Content-Type' => 'application/json'
                ],
                'body' => json_encode([
                    "name" => $req->name,
                    "email" => $req->email,
                    "password" => $req->password
                ])
            ]);
            $jsonResponse = json_decode(decrypt($response->getBody()->getContents()));
            // dd($jsonResponse);
            $res = [];
            if ($jsonResponse->status) {
                $res = [
                    'type' => 'success',
                    'message' => 'Berhasil Membuat akun!',
                ];
                return redirect()
                    ->route('page.auth.login')
                    ->with($res);
            } else {
                $res = [
                    'type' => 'error',
                    'message' => 'Gagal membuat akun, terdapat data yang salah!',
                ];
                return redirect()->route('page.auth.register')->with($res);
            }
        } catch (RequestException $th) {
            $res = [
                'type' => 'error',
                'message' => json_decode(decrypt($th->getResponse()->getBody()->getContents()))->message ?? 'Terjadi kesalahan!',
            ];
            return redirect()->route('page.auth.register')->with($res);
        }
    }
}
