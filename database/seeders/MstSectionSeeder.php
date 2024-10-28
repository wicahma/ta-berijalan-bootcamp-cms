<?php

namespace Database\Seeders;

use App\Models\mst_section;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class MstSectionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $data = [
            [
                'id' => 1,
                'name' => 'Frontend',
            ],
            [
                'id' => 2,
                'name' => 'Backend',
            ],
        ];

        foreach ($data as $item) {
            mst_section::create($item);
        }
    }
}
