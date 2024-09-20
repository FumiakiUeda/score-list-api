<?php

namespace App\Http\Controllers;

use App\Models\Score;
use App\Models\Part;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

class ScoreController extends Controller
{
    /**
     * 譜面の一覧を取得し、そのパート情報も含めて返す。
     *
     * @param \Illuminate\Http\Request $request ページ番号、並びの基準、降順昇順
     * @return \Illuminate\Http\Response 譜面一覧とそのパート情報を含むJSONレスポンス
     */
    public function index(Request $request)
    {
        // ログイン中のユーザーのみがアクセス可能
        if (!Auth::check()) {
            return response()->json(['error' => 'Unauthorized access'], 401);
        }

        // ログインユーザーを特定
        $user_id = Auth::id();

        // 必須パラメーターのデフォルトを指定
        $per_page = !empty($request->per_page) ? $request->per_page : 15;
        $sort = !empty($request->sort) ? $request->sort : 'id';
        $order = !empty($request->order) ? $request->order : 'asc';

        // 譜面一覧を取得
        if (!empty($request->search)) {
            $search = $request->search;
            $scores = Score::where('user_id', $user_id)
                ->where(function ($query) use ($search) {
                    $query->where('name', 'LIKE', '%' . $search . '%')
                        ->orWhere('composer', 'LIKE', '%' . $search . '%')
                        ->orWhere('arranger', 'LIKE', '%' . $search . '%');
                })
                ->orderBy($sort, $order)
                ->paginate($per_page);
        } else {
            $scores = Score::where('user_id', $user_id)
                ->orderBy($sort, $order)
                ->paginate($per_page);
        }

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
     * 新しい譜面を作成し、ストレージに保存する。
     * リクエストに含まれる情報に基づいて譜面とそのパート情報を保存する。
     *
     * @param \Illuminate\Http\Request $request 新しい譜面の情報を含むHTTPリクエスト
     * @return \Illuminate\Http\Response 作成された譜面情報とそのパート情報を含むJSONレスポンス
     */
    public function store(Request $request)
    {
        // ログイン中のユーザーのみがアクセス可能
        if (!Auth::check()) {
            return response()->json(['error' => 'Unauthorized access'], 401);
        }

        // ログインユーザーを特定
        $user_id = Auth::id();

        // リクエストの内容を譜面テーブルへ保存
        $score = new Score();
        $score->name = $request->name;
        $score->composer = $request->composer;
        $score->arranger = $request->arranger;
        $score->publisher = $request->publisher;
        $score->note = $request->note;
        $score->user_id = $user_id;
        $score->save();

        // リクエストの内容をパートテーブルへ保存
        if (!empty($request->part)) {
            foreach ($request->part as $value) {
                $part = new Part();
                $part->part_id = $value;
                $part->score_id = $score->id;
                $part->user_id = $user_id;
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
     * 指定されたIDの譜面を編集するための情報を取得する。
     * 譜面に対応するパート情報も含めて返す。
     *
     * @param string $id 編集する譜面のID
     * @return \Illuminate\Http\Response 譜面情報とそのパート情報を含むJSONレスポンス
     */
    public function edit(string $id)
    {
        // ログイン中のユーザーのみが編集可能
        if (!Auth::check()) {
            return response()->json(['error' => 'Unauthorized access'], 401);
        }

        // 該当のIDを検索
        $score = Score::findOrFail($id);

        // ユーザーIDが一致するか確認
        if (Auth::id() !== $score->user_id) {
            return response()->json(['error' => 'Forbidden'], 403);
        }

        // 該当の譜面に対応するパートがある場合は含める
        isset($score->part);

        // レスポンス
        return response()->json($score, 200);
    }

    /**
     * 指定された譜面を更新する。
     * リクエストに含まれる情報に基づいて譜面とそのパート情報を更新する。
     *
     * @param \Illuminate\Http\Request $request 更新する情報を含むHTTPリクエスト
     * @param \App\Models\Score $score 更新する譜面のインスタンス
     * @return \Illuminate\Http\Response 更新された譜面情報とそのパート情報を含むJSONレスポンス
     */
    public function update(Request $request, Score $score)
    {
        // ログイン中のユーザーのみが更新可能
        if (!Auth::check()) {
            return response()->json(['error' => 'Unauthorized access'], 401);
        }

        // ログインユーザーを特定
        $user_id = Auth::id();

        // リクエストの内容を譜面テーブルへ保存
        $score->name = $request->name;
        $score->composer = $request->composer;
        $score->arranger = $request->arranger;
        $score->publisher = $request->publisher;
        $score->note = $request->note;
        $score->user_id = $user_id;
        $score->save();

        // 既存のパート情報を先に削除
        Part::where([
            'user_id' => $user_id,
            'score_id' => $score->id,
        ])->delete();

        // リクエストの内容をパートテーブルへ保存
        if (!empty($request->part)) {
            foreach ($request->part as $value) {
                $part = new Part();
                $part->part_id = $value;
                $part->score_id = $score->id;
                $part->user_id = $user_id;
                $part->save();
            }
        }

        // レスポンスにパートの情報も含める
        isset($score->part);

        // レスポンス
        return response()->json($score, 200);
    }

    /**
     * 指定された譜面をストレージから削除する。
     * 譜面に対応するパートも併せて削除する。
     *
     * @param \App\Models\Score $score 削除する譜面のインスタンス
     * @return \Illuminate\Http\Response 削除操作の成功メッセージを含むJSONレスポンス
     */
    public function destroy(Score $score)
    {
        // ログイン中のユーザーのみが削除可能
        if (!Auth::check()) {
            return response()->json(['error' => 'Unauthorized access'], 401);
        }

        // ユーザーIDが一致するか確認
        if (Auth::id() !== $score->user_id) {
            return response()->json(['error' => 'Forbidden'], 403);
        }

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
