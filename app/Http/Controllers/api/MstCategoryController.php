<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use App\Http\Requests\CategoryRequest;
use App\Models\mst_category;
use App\Repositories\CategoryRepository;
use Illuminate\Http\Request;
use PhpParser\Node\Stmt\TryCatch;

class MstCategoryController extends Controller
{
    protected $category;

    public function __construct(CategoryRepository $category)
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

    public function createOrUpdate(CategoryRequest $request)
    {
        try {
            $data = $this->category->createOrUpdate($request);

            if (!$data) {
                return response()->json([
                    'status' => true,
                    'message' => $request->action === "update" ? 'Gagal memperbarui data Category!' : 'Gagal menambahkan data Category!',
                    'data' => null
                ], 400);
            }

            return response()->json([
                'status' => true,
                'message' => $request->action === "update" ? 'Berhasil memperbarui data Category!' : 'Berhasil menambahkan data Category!',
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


    public function destroy(CategoryRequest $request)
    {
        try {
            $data = $this->category->delete($request->id);

            return response()->json([
                'status' => true,
                'message' => 'Berhasil menghapus data Category!',
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

    public function restore(CategoryRequest $request)
    {
        try {
            $data = $this->category->restore($request->id);

            return response()->json([
                'status' => true,
                'message' => 'Berhasil mengembalikan data Category!',
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
