<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class PositionsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('positions')->insert([
            [
                'name' => 'Promotor',
            ],
            [
                'name' => 'Sales Retail',
            ],
            [
                'name' => 'Sales Industri',
            ],
            [
                'name' => 'Teknisi',
            ],
            [
                'name' => 'Admin',
            ],
            [
                'name' => 'Online',
            ],
            [
                'name' => 'Manager',
            ],
            [
                'name' => 'HR',
            ],
            [
                'name' => 'Produksi',
            ],
            [
                'name' => 'User',
            ],
        ]);
    }
}
