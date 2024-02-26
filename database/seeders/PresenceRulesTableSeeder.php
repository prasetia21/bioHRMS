<?php

namespace Database\Seeders;

use Carbon\Carbon;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class PresenceRulesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('presence_rules')->insert([
            [
                'arrived_time' => Carbon::parse('08:15:00')->format('h:i:s'),
                'leave_time' => Carbon::parse('16:00:00')->format('h:i:s'),
            ],
        ]);
    }
}
