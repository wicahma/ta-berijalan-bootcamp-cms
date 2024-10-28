<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use App\Http\Requests\TechstackRequest;
use App\Models\mst_techstack;
use App\Repositories\TechstackRepository;
use Illuminate\Http\Request;

class MstTechstackController extends Controller
{
    protected $techstack;

    public function __construct(TechstackRepository $techstack)
    {
        $this->techstack = $techstack;
    }


    public function index(TechstackRequest $request)
    {
        try {
            $data = $this->techstack->getAll($request->id);
            return response()->json([
                'status' => true,
                'message' => 'Berhasil mengambil data Techstack!',
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

    public function createOrUpdate(TechstackRequest $request)
    {
        try {
            $data = $this->techstack->createOrUpdate($request);

            if (!$data) {
                return response()->json([
                    'status' => true,
                    'message' => $request->action === "update" ? 'Gagal memperbarui data Techstack!' : 'Gagal menambahkan data Techstack!',
                    'data' => null
                ], 400);
            }

            return response()->json([
                'status' => true,
                'message' => $request->action === "update" ? 'Berhasil memperbarui data Techstack!' : 'Berhasil menambahkan data Techstack!',
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

    public function destroy(TechstackRequest $request)
    {
        try {
            $data = $this->techstack->delete($request->id);

            return response()->json([
                'status' => true,
                'message' => 'Berhasil menghapus data Techstack!',
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

    public function restore(TechstackRequest $request)
    {
        try {
            $data = $this->techstack->restore($request->id);

            return response()->json([
                'status' => true,
                'message' => 'Berhasil mengembalikan data Techstack!',
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
