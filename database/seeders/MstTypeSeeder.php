<?php

namespace Database\Seeders;

use App\Models\mst_type;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class MstTypeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $data =[
            [
                'id' => 1,
                'name' => 'Outsource',
            ],
            [
                'id' => 2,
                'name' => 'Freelance',
            ],
            [
                'id' => 3,
                'name' => 'Mitra',
            ],
        ];

        foreach ($data as $item) {
            mst_type::create($item);
        }
    }
}
