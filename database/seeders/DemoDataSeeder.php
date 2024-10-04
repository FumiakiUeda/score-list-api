<?php

namespace Database\Seeders;

use App\Models\Part;
use App\Models\Score;
use Illuminate\Database\Seeder;

class DemoDataSeeder extends Seeder
{
    /**
     * デモユーザーのデータを定期的にリセットする
     */
    public function run(): void
    {
        // デモアカウントのID
        $demo_id = 4;

        // 既存のデータを削除
        Score::where('user_id', $demo_id)->delete();
        Part::where('user_id', $demo_id)->delete();

        // デモデータを挿入
        $scores = [
            ['name' => '星条旗よ永遠なれ', 'composer' => 'J. P. スーザ', 'arranger' => NULL, 'publisher' => 6, 'note' => NULL, 'user_id' => $demo_id,],
            ['name' => '吹奏楽のための第1組曲', 'composer' => 'G. ホルスト', 'arranger' => NULL, 'publisher' => 6, 'note' => '伊藤康英校訂版', 'user_id' => $demo_id],
            ['name' => '吹奏楽のための第2組曲', 'composer' => 'G. ホルスト', 'arranger' => NULL, 'publisher' => 6, 'note' => '伊藤康英校訂版', 'user_id' => $demo_id],
            ['name' => 'カンタベリー・コラール', 'composer' => 'J. ヴァンデルロースト', 'arranger' => NULL, 'publisher' => 5, 'note' => NULL, 'user_id' => $demo_id],
            ['name' => 'さくらのうた', 'composer' => '福田洋介', 'arranger' => NULL, 'publisher' => 1, 'note' => '改訂版', 'user_id' => $demo_id],
            ['name' => 'アンパンマンのマーチ', 'composer' => '三木たかし', 'arranger' => '山下国俊', 'publisher' => 0, 'note' => NULL, 'user_id' => $demo_id],
            ['name' => 'リベルタンゴ【Libertango】', 'composer' => 'A. ピアソラ', 'arranger' => '本澤なおゆき', 'publisher' => 0, 'note' => '原曲はバンドネオン', 'user_id' => $demo_id],
            ['name' => 'アルヴァマー序曲', 'composer' => 'J. バーンズ', 'arranger' => NULL, 'publisher' => 6, 'note' => 'ベルウィン出版', 'user_id' => $demo_id],
            ['name' => 'イギリス民謡組曲', 'composer' => 'R. V. ウィリアムズ', 'arranger' => NULL, 'publisher' => 6, 'note' => 'ブージー＆ホークス', 'user_id' => $demo_id],
            ['name' => '風になりたい', 'composer' => '宮沢和史', 'arranger' => '浅野由莉', 'publisher' => 4, 'note' => 'フレックスバンド', 'user_id' => $demo_id],
            ['name' => '残酷な天使のテーゼ', 'composer' => '佐藤英敏', 'arranger' => '三浦秀秋', 'publisher' => 4, 'note' => NULL, 'user_id' => $demo_id],
            ['name' => 'Starry Journey -Prelude', 'composer' => '福田洋介', 'arranger' => NULL, 'publisher' => 1, 'note' => '小編成版', 'user_id' => $demo_id],
        ];
        Score::insert($scores);
        $parts = [
            ['part_id' => 5, 'score_id' => 154, 'user_id' => $demo_id],
            ['part_id' => 0, 'score_id' => 156, 'user_id' => $demo_id],
            ['part_id' => 10, 'score_id' => 159, 'user_id' => $demo_id],
            ['part_id' => 8, 'score_id' => 163, 'user_id' => $demo_id],
        ];
        Part::insert($parts);
    }
}
