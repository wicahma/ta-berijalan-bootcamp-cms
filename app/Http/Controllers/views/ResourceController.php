<?php

namespace App\Http\Controllers\views;

use App\Http\Controllers\Controller;
use GuzzleHttp\Client;
use GuzzleHttp\Exception\RequestException;
use Illuminate\Http\Request;

class ResourceController extends Controller
{
    protected $client;
    public function __construct()
    {
        $this->client = new Client();
    }
    public function index()
    {
        $resource_data = $this->reqAllResource();
        if (!$resource_data->status) {
            return redirect()->back()->with($resource_data);
        }

        return view('pages.resource.index', ['resource_data' => $resource_data->data]);
    }

    public function detail($IdResource)
    {
        $detail_data = $this->reqDetailResource($IdResource);

        if (!$detail_data->status) {
            return redirect()->back()->with($detail_data);
        }

        return view('pages.resource.detail', ['IdResource' => $IdResource, 'detail_data' => $detail_data->data]);
    }

    public function edit($IdResource)
    {
        $detail_data = $this->reqDetailResource($IdResource);

        if (!$detail_data->status) {
            return redirect()->back()->with($detail_data);
        }

        $techstack_data = $this->reqAllTechstack();

        if (!$techstack_data->status) {
            return redirect()->back()->with($techstack_data);
        }

        return view('pages.resource.edit', ['IdResource' => $IdResource, 'detail_data' => $detail_data->data, 'techstack_data' => $techstack_data->data]);
    }

    public function create()
    {
        $techstack_data = $this->reqAllTechstack();

        if (!$techstack_data->status) {
            return redirect()->back()->with($techstack_data);
        }

        return view('pages.resource.create', ['techstack_data' => $techstack_data->data]);
    }


    public function reqAllResource()
    {
        try {
            $token = session()->get('LoginSession');
            $response = $this->client->get(config('app.api_url') . '/resource', [
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

    public function reqDetailResource($id)
    {
        try {
            $token = session()->get('LoginSession');
            $response = $this->client->get(config('app.api_url') . '/resource?id=' . $id, [
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

    public function reqCreate(Request $request)
    {
        try {
            $token = session()->get('LoginSession');

            $newTechstack = [];

            foreach ($request->techstack as $tech) {
                array_push(
                    $newTechstack,
                    [
                        'id' => intval($tech['id']),
                        'level' => intval($tech['level']),
                    ]
                );
            }
            $response = $this->client->post(config('app.api_url') . '/resource', [
                'headers' => [
                    'Accept' => 'application/json',
                    'Content-Type' => 'application/json',
                    'Authorization' => 'Bearer ' . $token
                ],
                'body' => json_encode([
                    'name' => $request->name,
                    'email' => $request->email,
                    'npk' => $request->npk,
                    'phone_number' => $request->phone_number,
                    'section_id' => $request->section_id,
                    'role_id' => $request->role_id,
                    'type_id' => $request->type_id,
                    'category_id' => $request->category_id,
                    'techstack' => $newTechstack,
                ])
            ]);
            $jsonResponse = json_decode($response->getBody()->getContents());
            if ($jsonResponse->status) {
                $res = [
                    'status' => true,
                    'type' => 'success',
                    'message' => 'Berhasil menambahkan data Resource!',
                ];
                return redirect()->route('page.resource.index')->with($res);
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

            $newTechstack = [];

            foreach ($request->techstack as $tech) {
                array_push(
                    $newTechstack,
                    [
                        'id' => intval($tech['id']),
                        'level' => intval($tech['level']),
                    ]
                );
            }
            $response = $this->client->post(config('app.api_url') . '/resource', [
                'headers' => [
                    'Accept' => 'application/json',
                    'Content-Type' => 'application/json',
                    'Authorization' => 'Bearer ' . $token
                ],
                'body' => json_encode([
                    'id' => $request->id,
                    'name' => $request->name,
                    'email' => $request->email,
                    'npk' => $request->npk,
                    'phone_number' => $request->phone_number,
                    'section_id' => $request->section_id,
                    'role_id' => $request->role_id,
                    'type_id' => $request->type_id,
                    'category_id' => $request->category_id,
                    'techstack' => $newTechstack,
                ])
            ]);
            $jsonResponse = json_decode($response->getBody()->getContents());
            if ($jsonResponse->status) {
                $res = [
                    'status' => true,
                    'type' => 'success',
                    'message' => 'Berhasil mengupdate data Resource!',
                ];
                return redirect()->route('page.resource.index')->with($res);
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
            $response = $this->client->delete(config('app.api_url') . '/resource?id=' . $id, [
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
                    'message' => 'Berhasil menghapus data Resource!',
                ];
                return redirect()->route('page.resource.index')->with($res);
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
