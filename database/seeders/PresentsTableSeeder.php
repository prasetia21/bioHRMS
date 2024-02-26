<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class PresentsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('presents')->insert([
            [
                'name' => 'Tepat Waktu',
            ],
            [
                'name' => 'Sakit',
            ],
            [
                'name' => 'Terlambat',
            ],
            [
                'name' => 'Ijin',
            ],
            [
                'name' => 'Cuti',
            ],
        ]);
    }
}
