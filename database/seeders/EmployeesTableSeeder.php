<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class EmployeesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('employees')->insert([
            [
                'fullname' => 'testing',
                'password' => Hash::make('12345678'),
                'position_id' => 8,
                'departement_id' => 5,
                'phone' => '012345678',
            ],
            [
                'fullname' => 'testing-hr',
                'password' => Hash::make('12345678'),
                'position_id' => 7,
                'departement_id' => 5,
                'phone' => '87654321',
            ],
            [
                'fullname' => 'testing-sidikan',
                'password' => Hash::make('12345678'),
                'position_id' => 1,
                'departement_id' => 1,
                'phone' => '0812345678',
            ],
        ]);
    }
}
