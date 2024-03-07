<?php

namespace App\Http\Controllers;

use App\Models\Score;
use Illuminate\Http\Request;

class ScoreController extends Controller
{
    /**
     * リソースの一覧を表示する。
     */
    public function index()
    {
        $scores = Score::all();
        return response()->json([
            'data' => $scores
        ], 200);
    }

    /**
     * 新しいリソースを作成するフォームを表示する。
     */
    public function create()
    {
        //
    }

    /**
     * 新しく作成したリソースをストレージに格納する。
     */
    public function store(Request $request)
    {
        $score = new Score();
        $score->name = $request->name;
        $score->composer = $request->composer;
        $score->arranger = $request->arranger;
        $score->publisher = $request->publisher;
        $score->note = $request->note;
        $score->user_id = $request->user_id;
        $score->save();
        return response()->json([
            'data' => $score
        ], 201);
    }

    /**
     * 指定されたリソースを表示する。
     */
    public function show(string $id)
    {
        //
    }

    /**
     * 指定したリソースを編集するためのフォームを表示します。
     */
    public function edit(string $id)
    {
        $score = Score::find($id);
        return response()->json([
            'data' => $score
        ], 200);
    }

    /**
     * ストレージ内の指定されたリソースを更新する。
     */
    public function update(Request $request, Score $score)
    {
        $score->fill($request->all());
        $score->save();
        return response()->json([
            'data' => $score
        ], 200);
    }

    /**
     * 指定されたリソースをストレージから削除する。
     */
    public function destroy(Score $score)
    {
        $score->delete();
        return response()->json([
            'message' => 'deleted successfully.'
        ], 200);
    }
}
