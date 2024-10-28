<?php

namespace App\Repositories;

use App\Models\mst_category;
use Exception;

class CategoryRepository
{
    protected $category;

    public function __construct(mst_category $category)
    {
        $this->category = $category;
    }

    public function getAll()
    {
        return $this->category->all();
    }

    public function createOrUpdate($data)
    {
        $isCategoryExist = $this->category->find($data->id);

        if ($data->id !== null && !$isCategoryExist) {
            throw new Exception('Data tidak ditemukan!');
        }

        $res = $this->category->updateOrCreate(
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
        $category = $this->category->find($id);

        if (!$category) {
            throw new Exception('Data tidak ditemukan!');
        }

        return $category->delete();
    }

    public function restore($id)
    {
        $category = $this->category->withTrashed()->find($id);

        if (!$category) {
            throw new Exception('Data tidak ditemukan!');
        }

        return $category->restore();
    }
}