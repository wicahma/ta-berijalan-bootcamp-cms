<?php

namespace App\Repositories;

use App\Models\mst_techstack;
use Exception;

class TechstackRepository
{
    protected $techstack;

    public function __construct(mst_techstack $techstack)
    {
        $this->techstack = $techstack;
    }

    public function getAll($id = null)
    {

        if ($id) {
            $res = $this
                ->techstack
                ->with('section')
                ->find(intval($id));

            if (!$res) {
                throw new Exception('Data tidak ditemukan!');
            }

            return $res;
        }

        return $this
            ->techstack
            ->with('section')
            ->get();
    }

    public function createOrUpdate($data)
    {
        $isTechstackExist = $this->techstack->find($data->id);

        if ($data->id !== null && !$isTechstackExist) {
            throw new Exception('Data tidak ditemukan!');
        }
        // dd($data);
        $res = $this->techstack->updateOrCreate(
            [
                'id' => $data->id
            ],
            [
                'name' => $data->name,
                'section_id' => $data->section_id,
                'is_active' => $data->is_active,
                'updated_at' => now(),
            ]
        );

        if (!$res)
            throw new Exception('Gagal menambahkan data Techstack!');

        return $res;
    }

    public function delete($id)
    {
        $data = $this->techstack->find($id);

        if (!$data) {
            throw new Exception('Data tidak ditemukan!');
        }

        return $data->delete();
    }

    public function restore($id)
    {
        $data = $this->techstack->withTrashed()->find($id);

        if (!$data) {
            throw new Exception('Data tidak ditemukan!');
        }

        return $data->restore();
    }
}