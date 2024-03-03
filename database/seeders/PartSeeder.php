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
                'part' => 1,
                'score_id' => 1,
            ],
            [
                'part' => 2,
                'score_id' => 1,
            ],
            [
                'part' => 2,
                'score_id' => 2,
            ],
            [
                'part' => 3,
                'score_id' => 2,
            ],
            [
                'part' => 4,
                'score_id' => 2,
            ],
        ];
        foreach ($parts as $part) {
            DB::table('parts')->insert([
                'part' => $part['part'],
                'score_id' => $part['score_id'],
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ]);
        }
    }
}
