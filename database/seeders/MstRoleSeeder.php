<?php

namespace Database\Seeders;

use App\Models\mst_role;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class MstRoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $data = [
            [
                'id' => 1,
                'name' => 'Developer',
            ],
            [
                'id' => 3,
                'name' => 'System Analyst',
            ],
            [
                'id' => 4,
                'name' => 'Bussiness Analyst',
            ],
            [
                'id' => 5,
                'name' => 'Quality Control',
            ],
        ];

        foreach ($data as $item) {
            mst_role::create($item);
        }
    }
}
