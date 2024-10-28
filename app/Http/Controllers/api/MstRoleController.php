<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use App\Http\Requests\RoleRequest;
use App\Models\mst_role;
use App\Repositories\RoleRepository;
use Illuminate\Http\Request;

class MstRoleController extends Controller
{
    protected $role;

    public function __construct(RoleRepository $role)
    {
        $this->role = $role;
    }

    public function index()
    {
        try {
            $data = $this->role->getAll();
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

    public function createOrUpdate(RoleRequest $request)
    {
        try {
            $data = $this->role->createOrUpdate($request);

            if (!$data) {
                return response()->json([
                    'status' => true,
                    'message' => $request->action === "update" ? 'Gagal memperbarui data Role!' : 'Gagal menambahkan data Role!',
                    'data' => null
                ], 400);
            }

            return response()->json([
                'status' => true,
                'message' => $request->action === "update" ? 'Berhasil memperbarui data Role!' : 'Berhasil menambahkan data Role!',
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


    public function destroy(RoleRequest $request)
    {
        try {
            $data = $this->role->delete($request->id);

            return response()->json([
                'status' => true,
                'message' => 'Berhasil menghapus data Role!',
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

    public function restore(RoleRequest $request)
    {
        try {
            $data = $this->role->restore($request->id);

            return response()->json([
                'status' => true,
                'message' => 'Berhasil mengembalikan data Role!',
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
