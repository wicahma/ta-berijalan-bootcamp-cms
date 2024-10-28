<?php

namespace Database\Seeders;

use App\Models\mst_category;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class MstCategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $data = [
            [
                'id' => 1,
                'name' => 'Graded',
            ],
            [
                'id' => 2,
                'name' => 'Ungraded',
            ],
        ];

        foreach ($data as $item) {
            mst_category::create($item);
        }
    }
}
