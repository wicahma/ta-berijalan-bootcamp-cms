<?php

namespace App\Repositories;

use App\Models\mst_section;
use Exception;

class SectionRepository
{
    protected $section;

    public function __construct(mst_section $section)
    {
        $this->section = $section;
    }

    public function getAll()
    {
        return $this->section->all();
    }

    public function createOrUpdate($data)
    {
        $isSectionExist = $this->section->find($data->id);

        if ($data->id !== null && !$isSectionExist) {
            throw new Exception('Data tidak ditemukan!');
        }

        $res = $this->section->updateOrCreate(
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
        $section = $this->section->find($id);

        if (!$section) {
            throw new Exception('Data tidak ditemukan!');
        }

        return $section->delete();
    }

    public function restore($id)
    {
        $section = $this->section->withTrashed()->find($id);

        if (!$section) {
            throw new Exception('Data tidak ditemukan!');
        }

        return $section->restore();
    }
}