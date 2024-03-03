<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class ScoreSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $scores = [
            [
                'name' => 'Starry Journey',
                'composer' => '福田洋介',
                'arranger' => '',
                'publisher' => 3,
                'note' => '',
            ],
            [
                'name' => '吹奏楽のための第1組曲',
                'composer' => 'G.ホルスト',
                'arranger' => '',
                'publisher' => 4,
                'note' => '',
            ],
        ];
        foreach ($scores as $score) {
            DB::table('scores')->insert([
                'name' => $score['name'],
                'composer' => $score['composer'],
                'arranger' => $score['arranger'],
                'publisher' => $score['publisher'],
                'note' => $score['note'],
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ]);
        }
    }
}
