<?php

namespace App\Repositories;

use App\Models\mst_role;
use Exception;

class RoleRepository
{
    protected $role;

    public function __construct(mst_role $role)
    {
        $this->role = $role;
    }

    public function getAll()
    {
        return $this->role->all();
    }

    public function createOrUpdate($data)
    {
        $isRoleExist = $this->role->find($data->id);

        if ($data->id !== null && !$isRoleExist) {
            throw new Exception('Data tidak ditemukan!');
        }

        $res = $this->role->updateOrCreate(
            [
                'id' => $data->id
            ],
            [
                'name' => $data->name,
                'is_active' => $data->is_active,
                'updated_at' => now(),
            ]
        );

        return $res;
    }

    public function delete($id)
    {
        $role = $this->role->find($id);

        if (!$role) {
            throw new Exception('Data tidak ditemukan!');
        }

        return $role->delete();
    }

    public function restore($id)
    {
        $role = $this->role->withTrashed()->find($id);

        if (!$role) {
            throw new Exception('Data tidak ditemukan!');
        }

        return $role->restore();
    }
}