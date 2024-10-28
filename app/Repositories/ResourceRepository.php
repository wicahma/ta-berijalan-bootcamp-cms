<?php

namespace App\Repositories;

use App\Models\mst_resource;
use Exception;

class ResourceRepository
{
    protected $resource;

    public function __construct(mst_resource $resource)
    {
        $this->resource = $resource;
    }

    public function getAll($id = null)
    {

        if ($id) {
            $res = $this
                ->resource
                ->with('section')
                ->with('type')
                ->with('role')
                ->with('category')
                ->with('tbl_techstacks')
                ->find(intval($id));
            if (!$res) {
                throw new Exception('Data tidak ditemukan!');
            }

            return $res;
        }

        return $this->resource
            ->with('section')
            ->with('type')
            ->with('role')
            ->with('category')
            ->get();
    }

    public function getOne($id)
    {
        $resource = $this->resource->find($id);

        if (!$resource) {
            throw new Exception('Data tidak ditemukan!');
        }

        return $resource;
    }

    public function createOrUpdate($data)
    {
        // $user_id = auth()->user()->id;
        $isResourceExist = $this->resource->find($data->id);

        if ($data->id !== null && !$isResourceExist) {
            throw new Exception('Data tidak ditemukan!');
        }
        // dd($data);
        $res = $this->resource->updateOrCreate(
            [
                'id' => $data->id
            ],
            [
                'section_id' => $data->section_id,
                'role_id' => $data->role_id,
                'type_id' => $data->type_id,
                'category_id' => $data->category_id,
                'name' => $data->name,
                'npk' => $data->npk,
                'email' => $data->email,
                'phone_number' => $data->phone_number,
                'updated_at' => now(),
            ]
        );

        if ($res && $data->techstack) {
            $newTechstack = [];

            foreach ($data->techstack as $tech) {
                $newTechstack[] = [
                    'resource_id' => $res->id,
                    'techstack_id' => $tech['id'],
                    'level' => $tech['level'],
                ];
            }

            if ($res->tbl_techstacks()->exists())
                $res->tbl_techstacks()->delete();
            $res->tbl_techstacks()->createMany($newTechstack);
        }

        return $res;
    }

    public function delete($id)
    {
        $data = $this->resource->find($id);

        if (!$data) {
            throw new Exception('Data tidak ditemukan!');
        }

        return $data->delete();
    }

    public function restore($id)
    {
        $data = $this->resource->withTrashed()->find($id);

        if (!$data) {
            throw new Exception('Data tidak ditemukan!');
        }

        return $data->restore();
    }
}