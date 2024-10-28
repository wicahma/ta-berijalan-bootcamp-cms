<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use App\Http\Requests\SectionRequest;
use App\Models\mst_section;
use App\Repositories\SectionRepository;
use Illuminate\Http\Request;

class MstSectionController extends Controller
{
    protected $section;

    public function __construct(SectionRepository $section)
    {
        $this->section = $section;
    }

    public function index()
    {
        try {
            $data = $this->section->getAll();
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

    public function createOrUpdate(SectionRequest $request)
    {
        try {
            $data = $this->section->createOrUpdate($request);

            if (!$data) {
                return response()->json([
                    'status' => true,
                    'message' => $request->action === "update" ? 'Gagal memperbarui data Section!' : 'Gagal menambahkan data Section!',
                    'data' => null
                ], 400);
            }

            return response()->json([
                'status' => true,
                'message' => $request->action === "update" ? 'Berhasil memperbarui data Section!' : 'Berhasil menambahkan data Section!',
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


    public function destroy(SectionRequest $request)
    {
        try {
            $data = $this->section->delete($request->id);

            return response()->json([
                'status' => true,
                'message' => 'Berhasil menghapus data Section!',
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

    public function restore(SectionRequest $request)
    {
        try {
            $data = $this->section->restore($request->id);

            return response()->json([
                'status' => true,
                'message' => 'Berhasil mengembalikan data Section!',
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
