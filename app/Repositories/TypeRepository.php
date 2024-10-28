<?php

namespace App\Repositories;

use App\Models\mst_type;
use Exception;

class TypeRepository
{
    protected $type;

    public function __construct(mst_type $type)
    {
        $this->type = $type;
    }

    public function getAll()
    {
        return $this->type->all();
    }

    public function createOrUpdate($data)
    {
        $isTypeExist = $this->type->find($data->id);

        if ($data->id !== null && !$isTypeExist) {
            throw new Exception('Data tidak ditemukan!');
        }

        $res = $this->type->updateOrCreate(
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
        $type = $this->type->find($id);

        if (!$type) {
            throw new Exception('Data tidak ditemukan!');
        }

        return $type->delete();
    }

    public function restore($id)
    {
        $type = $this->type->withTrashed()->find($id);

        if (!$type) {
            throw new Exception('Data tidak ditemukan!');
        }

        return $type->restore();
    }
}