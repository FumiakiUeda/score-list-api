<?php

namespace App\Http\Controllers;

use App\Models\Score;
use App\Models\Part;
use Illuminate\Http\Request;

class ScoreController extends Controller
{
    /**
     * 譜面の一覧を取得し、そのパート情報も含めて返します。
     *
     * @return \Illuminate\Http\Response 譜面一覧とそのパート情報を含むJSONレスポンス
     */
    public function index()
    {
        // 譜面一覧を取得
        $scores = Score::all();

        // 譜面に対応するパート一覧を取得
        foreach ($scores as $score) {
            isset($score->part);
        }

        // レスポンス
        return response()->json($scores, 200);
    }

    /**
     * 新しいリソースを作成するフォームを表示する。
     */
    public function create()
    {
        //
    }

    /**
     * 新しい譜面を作成し、ストレージに保存します。
     * リクエストに含まれる情報に基づいて譜面とそのパート情報を保存します。
     *
     * @param \Illuminate\Http\Request $request 新しい譜面の情報を含むHTTPリクエスト
     * @return \Illuminate\Http\Response 作成された譜面情報とそのパート情報を含むJSONレスポンス
     */
    public function store(Request $request)
    {
        // リクエストの内容を譜面テーブルへ保存
        $score = new Score();
        $score->name = $request->name;
        $score->composer = $request->composer;
        $score->arranger = $request->arranger;
        $score->publisher = $request->publisher;
        $score->note = $request->note;
        $score->user_id = $request->user_id;
        $score->save();

        // リクエストの内容をパートテーブルへ保存
        if (!empty($request->part)) {
            foreach ($request->part as $value) {
                $part = new Part();
                $part->part_id = $value;
                $part->score_id = $score->id;
                $part->user_id = $score->user_id;
                $part->save();
            }
        }

        // レスポンスにパートの情報も含める
        isset($score->part);

        // レスポンス
        return response()->json($score, 201);
    }

    /**
     * 指定されたリソースを表示する。
     */
    public function show(string $id)
    {
        //
    }

    /**
     * 指定されたIDの譜面を編集するための情報を取得します。
     * 譜面に対応するパート情報も含めて返します。
     *
     * @param string $id 編集する譜面のID
     * @return \Illuminate\Http\Response 譜面情報とそのパート情報を含むJSONレスポンス
     */
    public function edit(string $id)
    {
        // 該当のIDを検索
        $score = Score::find($id);

        // 該当の譜面に対応するパートがある場合は含める
        isset($score->part);

        // レスポンス
        return response()->json($score, 200);
    }

    /**
     * 指定された譜面を更新します。
     * リクエストに含まれる情報に基づいて譜面とそのパート情報を更新します。
     *
     * @param \Illuminate\Http\Request $request 更新する情報を含むHTTPリクエスト
     * @param \App\Models\Score $score 更新する譜面のインスタンス
     * @return \Illuminate\Http\Response 更新された譜面情報とそのパート情報を含むJSONレスポンス
     */
    public function update(Request $request, Score $score)
    {
        // リクエストの内容を譜面テーブルへ保存
        $score->name = $request->name;
        $score->composer = $request->composer;
        $score->arranger = $request->arranger;
        $score->publisher = $request->publisher;
        $score->note = $request->note;
        $score->user_id = $request->user_id;
        $score->save();

        // 既存のパート情報を先に削除
        Part::where([
            'user_id' => $score->user_id,
            'score_id' => $score->id,
        ])->delete();

        // リクエストの内容をパートテーブルへ保存
        if (!empty($request->part)) {
            foreach ($request->part as $value) {
                $part = new Part();
                $part->part_id = $value;
                $part->score_id = $score->id;
                $part->user_id = $score->user_id;
                $part->save();
            }
        }

        // レスポンスにパートの情報も含める
        isset($score->part);

        // レスポンス
        return response()->json($score, 200);
    }

    /**
     * 指定された譜面をストレージから削除します。
     * 譜面に対応するパートも併せて削除します。
     *
     * @param \App\Models\Score $score 削除する譜面のインスタンス
     * @return \Illuminate\Http\Response 削除操作の成功メッセージを含むJSONレスポンス
     */
    public function destroy(Score $score)
    {
        // 該当のレコードを削除
        $score->delete();

        // 譜面に対応するパートも併せて削除
        Part::where([
            'user_id' => $score->user_id,
            'score_id' => $score->id,
        ])->delete();

        // レスポンス
        return response()->json([
            'message' => 'deleted successfully.'
        ], 200);
    }
}
