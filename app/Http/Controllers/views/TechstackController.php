<?php

namespace App\Http\Controllers\views;

use App\Http\Controllers\Controller;
use GuzzleHttp\Client;
use GuzzleHttp\Exception\RequestException;
use Illuminate\Http\Request;

class TechstackController extends Controller
{

    protected $client;
    public function __construct()
    {
        $this->client = new Client();
    }

    public function index()
    {
        $techstack_data = $this->reqAllTechstack();

        if (!$techstack_data->status) {
            return redirect()->back()->with($techstack_data);
        }

        return view('pages.techstack.index', [
            'techstack_data' => $techstack_data->data,
        ]);
    }


    public function reqAllTechstack()
    {
        try {
            $token = session()->get('LoginSession');
            $response = $this->client->get(config('app.api_url') . '/techstack', [
                'headers' => [
                    'Accept' => 'application/json',
                    'Content-Type' => 'application/json',
                    'Authorization' => 'Bearer ' . $token
                ],
            ]);
            return json_decode($response->getBody()->getContents());
        } catch (RequestException $th) {
            $res = [
                'status' => false,
                'type' => 'error',
                'message' => json_decode($th->getResponse()->getBody()->getContents())->message ?? 'Terjadi kesalahan!',
            ];
            return $res;
        }
    }

    public function reqDelete($id)
    {
        try {
            $token = session()->get('LoginSession');
            $response = $this->client->delete(config('app.api_url') . '/techstack?id=' . $id, [
                'headers' => [
                    'Accept' => 'application/json',
                    'Content-Type' => 'application/json',
                    'Authorization' => 'Bearer ' . $token
                ],
            ]);
            $jsonResponse = json_decode($response->getBody()->getContents());

            if ($jsonResponse->status) {
                $res = [
                    'status' => true,
                    'type' => 'success',
                    'message' => 'Berhasil menghapus data Techstack!',
                ];
                return redirect()->route('page.techstack.index')->with($res);
            } else {
                $res = [
                    'status' => false,
                    'type' => 'error',
                    'message' => $jsonResponse->message,
                ];
                return redirect()->back()->with($res);
            }
        } catch (RequestException $th) {
            $res = [
                'status' => false,
                'type' => 'error',
                'message' => json_decode($th->getResponse()->getBody()->getContents())->message ?? 'Terjadi kesalahan!',
            ];
            return redirect()->back()->with($res);
        }
    }

    public function reqCreate(Request $request)
    {
        try {
            $token = session()->get('LoginSession');

            $response = $this->client->post(config('app.api_url') . '/techstack', [
                'headers' => [
                    'Accept' => 'application/json',
                    'Content-Type' => 'application/json',
                    'Authorization' => 'Bearer ' . $token
                ],
                'body' => json_encode([
                    'name' => $request->name,
                    'section_id' => intval($request->section_id),
                    'is_active' => true,
                    'action' => 'create'
                ])
            ]);
            $jsonResponse = json_decode($response->getBody()->getContents());
            if ($jsonResponse->status) {
                $res = [
                    'status' => true,
                    'type' => 'success',
                    'message' => 'Berhasil menambahkan data Techstack!',
                ];
                return redirect()->route('page.techstack.index')->with($res);
            } else {
                $res = [
                    'status' => false,
                    'type' => 'error',
                    'message' => $jsonResponse->message,
                ];
                return redirect()->back()->with($res);
            }
        } catch (RequestException $th) {
            $res = [
                'status' => false,
                'type' => 'error',
                'message' => json_decode($th->getResponse()->getBody()->getContents())->message ?? 'Terjadi kesalahan!',
            ];
            return redirect()->back()->with($res);
        }
    }

    public function reqUpdate(Request $request)
    {
        try {
            $token = session()->get('LoginSession');

            $response = $this->client->post(config('app.api_url') . '/techstack', [
                'headers' => [
                    'Accept' => 'application/json',
                    'Content-Type' => 'application/json',
                    'Authorization' => 'Bearer ' . $token
                ],
                'body' => json_encode([
                    'id' => intval($request->id),
                    'name' => $request->name,
                    'section_id' => intval($request->section_id),
                    'is_active' => true,
                    'action' => 'update'
                ])
            ]);
            $jsonResponse = json_decode($response->getBody()->getContents());
            if ($jsonResponse->status) {
                $res = [
                    'status' => true,
                    'type' => 'success',
                    'message' => 'Berhasil mengupdate data Resource!',
                ];
                return redirect()->route('page.techstack.index')->with($res);
            } else {
                $res = [
                    'status' => false,
                    'type' => 'error',
                    'message' => $jsonResponse->message,
                ];
                return redirect()->back()->with($res);
            }
        } catch (RequestException $th) {
            $res = [
                'status' => false,
                'type' => 'error',
                'message' => json_decode($th->getResponse()->getBody()->getContents())->message ?? 'Terjadi kesalahan!',
            ];
            return redirect()->back()->with($res);
        }
    }
}
