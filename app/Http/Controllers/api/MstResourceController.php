<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use App\Http\Requests\ResourceRequest;
use App\Repositories\ResourceRepository;
use Illuminate\Http\Request;

class MstResourceController extends Controller
{

    protected $resource;

    public function __construct(ResourceRepository $resource)
    {
        $this->resource = $resource;
    }


    public function index(ResourceRequest $request)
    {
        try {
            $data = $this->resource->getAll($request->id);
            return response()->json([
                'status' => true,
                'message' => 'Berhasil mengambil data Resource!',
                'data' => $data
            ], 200);
        } catch (\Throwable $th) {
            return response()->json([
                'status' => false,
                'message' => $th->getMessage(),
                'data' => null
            ], 400);
        }
    }

    public function createOrUpdate(ResourceRequest $request)
    {
        try {
            $data = $this->resource->createOrUpdate($request);

            if (!$data) {
                return response()->json([
                    'status' => true,
                    'message' => $request->action === "update" ? 'Gagal memperbarui data Resource!' : 'Gagal menambahkan data Resource!',
                    'data' => null
                ], 400);
            }

            return response()->json([
                'status' => true,
                'message' => $request->action === "update" ? 'Berhasil memperbarui data Resource!' : 'Berhasil menambahkan data Resource!',
                'data' => $data
            ], $request->action === "update" ? 200 : 201);

        } catch (\Throwable $th) {
            return response()->json([
                'status' => false,
                'message' => $th->getMessage(),
                'data' => null
            ], 400);
        }
    }

    public function show(ResourceRequest $request)
    {
        try {
            $data = $this->resource->getOne($request->id);
            return response()->json([
                'status' => true,
                'message' => 'Berhasil mengambil data Resource!',
                'data' => $data
            ], 200);
        } catch (\Throwable $th) {
            return response()->json([
                'status' => false,
                'message' => $th->getMessage(),
                'data' => null
            ], 400);
        }
    }

    public function destroy(ResourceRequest $request)
    {
        try {
            $data = $this->resource->delete($request->id);

            return response()->json([
                'status' => true,
                'message' => 'Berhasil menghapus data Resource!',
                'data' => $data
            ], 200);

        } catch (\Throwable $th) {
            return response()->json([
                'status' => false,
                'message' => $th->getMessage(),
                'data' => null
            ], 500);
        }
    }

    public function restore(ResourceRequest $request)
    {
        try {
            $data = $this->resource->restore($request->id);

            return response()->json([
                'status' => true,
                'message' => 'Berhasil mengembalikan data Resource!',
                'data' => $data
            ], 200);

        } catch (\Throwable $th) {
            return response()->json([
                'status' => false,
                'message' => $th->getMessage(),
                'data' => null
            ], 500);
        }
    }
}
