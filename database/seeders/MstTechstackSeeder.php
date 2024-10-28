<?php

namespace Database\Seeders;

use App\Models\mst_techstack;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class MstTechstackSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $data =[
            [
                'id' => 1,
                'name' => 'PHP',
                'section_id' => 2,
            ],
            [
                'id' => 2,
                'name' => 'Laravel',
                'section_id' => 2,
            ],
            [
                'id' => 3,
                'name' => 'Vue.js',
                'section_id' => 1,
            ],
            [
                'id' => 4,
                'name' => 'React.js',
                'section_id' => 1,
            ],
            [
                'id' => 5,
                'name' => 'Angular.js',
                'section_id' => 1,
            ],
        ];

        foreach ($data as $item) {
            mst_techstack::create($item);
        }
    }
}
