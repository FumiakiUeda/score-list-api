<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class PartSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $parts = [
            [
                'part_id' => 1,
                'score_id' => 1,
                'user_id' => 1,
            ],
            [
                'part_id' => 2,
                'score_id' => 1,
                'user_id' => 1,
            ],
            [
                'part_id' => 2,
                'score_id' => 2,
                'user_id' => 1,
            ],
            [
                'part_id' => 3,
                'score_id' => 2,
                'user_id' => 1,
            ],
            [
                'part_id' => 4,
                'score_id' => 2,
                'user_id' => 1,
            ],
        ];
        foreach ($parts as $part) {
            DB::table('parts')->insert([
                'part_id' => $part['part_id'],
                'score_id' => $part['score_id'],
                'user_id' => $part['user_id'],
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ]);
        }
    }
}
