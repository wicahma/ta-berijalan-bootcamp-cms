<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use App\Http\Requests\TypeRequest;
use App\Models\mst_type;
use App\Repositories\TypeRepository;
use Illuminate\Http\Request;

class MstTypeController extends Controller
{
    protected $category;

    public function __construct(TypeRepository $category)
    {
        $this->category = $category;
    }

    public function index()
    {
        try {
            $data = $this->category->getAll();
            return response()->json([
                'status' => true,
                'message' => 'Berhasil mengambil data Kategori!',
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

    public function createOrUpdate(TypeRequest $request)
    {
        try {
            $data = $this->category->createOrUpdate($request);

            if (!$data) {
                return response()->json([
                    'status' => true,
                    'message' => $request->action === "update" ? 'Gagal memperbarui data Type!' : 'Gagal menambahkan data Type!',
                    'data' => null
                ], 400);
            }

            return response()->json([
                'status' => true,
                'message' => $request->action === "update" ? 'Berhasil memperbarui data Type!' : 'Berhasil menambahkan data Type!',
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


    public function destroy(TypeRequest $request)
    {
        try {
            $data = $this->category->delete($request->id);

            return response()->json([
                'status' => true,
                'message' => 'Berhasil menghapus data Type!',
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

    public function restore(TypeRequest $request)
    {
        try {
            $data = $this->category->restore($request->id);

            return response()->json([
                'status' => true,
                'message' => 'Berhasil mengembalikan data Type!',
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
