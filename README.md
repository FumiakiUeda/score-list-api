# 譜面リスト作成ツール（バックエンド）

このプロジェクトは吹奏楽のスコアを管理するためのツール「譜面リスト作成ツール」のバックエンド側のソースです。  
`Laravel` を使用して作成されています。

フロントエンド側は [FumiakiUeda / score-list-ui](https://github.com/FumiakiUeda/score-list-ui) です。

## API一覧

### アプリケーション関係

|エンドポイント|メソッド|説明|
|--|--|--|
|/scores|GET|譜面データ(一覧)取得|
|/scores|POST|譜面データ新規保存|
|/score/{score:id}|GET|譜面データ(個別)取得|
|/score/{score:id}|PATCH|譜面データ更新|
|/score/{score:id}|DELETE|譜面データ削除|

### ユーザー認証関係

|エンドポイント|メソッド|説明|
|--|--|--|
|/register|POST|ユーザー新規登録|
|/login|POST|ユーザーログイン|
|/logout|POST|ユーザーログアウト|
|/forgot-password|POST|パスワードリセット用メール送信|
|/reset-password|POST|パスワードリセット|
|/sanctum/csrf-cookie|GET|XSRF-TOKENトークン取得|
