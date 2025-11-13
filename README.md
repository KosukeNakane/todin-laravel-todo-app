# Todin - Laravel ToDo App

チーム/個人でのタスク管理を想定した Laravel 10 製アプリです。ToDo の作成から並び替え、ユーザー情報・パスワード管理まで、仕様要件で求められている機能を 1 つの画面群に集約しています。

## 機能ハイライト

-   モーダルベースのタスク作成/編集/削除フローと、完了済みタスクのグレーアウト表示。
-   期日・優先度の並び替え、完了トグル、詳細閲覧などを 1 画面で操作。
-   ユーザー設定画面でのプロフィール更新とパスワード変更（英数字を含む 8 文字以上）。
-   ログアウト時の確認モーダルなど、共通 UI/UX を Tailwind CSS + Alpine.js で構築。

## 仕様要件との対応

### ToDo リスト管理

| No  | 仕様                | 説明                                                                 | 主な実装                                                                                                                             |
| --- | ------------------- | -------------------------------------------------------------------- | ------------------------------------------------------------------------------------------------------------------------------------ |
| 1   | ToDo 追加機能       | モーダルからタイトル/期日/優先度/説明を登録。                        | `resources/views/components/features/todo/modals/create-task.blade.php`, `app/Http/Controllers/TodoController@store`                 |
| 2   | ToDo 一覧機能       | `/index` でカード表示、概要/期日/優先度を確認。                      | `resources/views/pages/todo/index.blade.php`, `resources/views/components/features/todo/task-card.blade.php`, `TodoController@index` |
| 3   | ToDo 編集機能       | 各カードから編集モーダルを開き、項目を更新。                         | `resources/views/components/features/todo/modals/edit-task.blade.php`, `TodoController@update`                                       |
| 4   | ToDo 削除機能       | 削除モーダルで確認後に削除 API を実行。                              | `resources/views/components/features/todo/modals/delete-task.blade.php`, `TodoController@destroy`                                    |
| 5   | 完了/未完了チェック | 完了トグルボタンで状態を変更し、完了済みカードを自動でグレーアウト。 | `resources/views/components/features/todo/task-card.blade.php`, `TodoController@complete`                                            |
| 6   | 並び替え機能        | 期日・優先度・生成順を昇降順切替でソート可能。                       | `resources/views/pages/todo/index.blade.php` ,`TodoController@index`                                                                 |

### ユーザー管理機能

| No  | 仕様             | 説明                                                                                        | 主な実装                                                                                                                                            |
| --- | ---------------- | ------------------------------------------------------------------------------------------- | --------------------------------------------------------------------------------------------------------------------------------------------------- |
| 1   | ユーザー登録     | Breeze ベースの登録画面。パスワードは英数字を含む 8 文字以上でハッシュ化保存。              | `resources/views/pages/auth/register/index.blade.php`, `RegisteredUserController@store`, `App\Providers\AppServiceProvider`（`Password::defaults`） |
| 2   | ログイン         | `/login` からメール（ユーザー名相当）とパスワードで認証。失敗時はバリデーションエラー表示。 | `resources/views/pages/auth/login/index.blade.php`, `AuthenticatedSessionController@store`                                                          |
| 3   | ユーザー情報編集 | `/user` で名前・メールの更新と、パスワード変更モーダル。                                    | `resources/views/pages/user/user.blade.php`, `UserController@update`, `PasswordController@update`                                                   |
| 4   | ログアウト       | ヘッダーの「ログアウト」から確認モーダル経由でセッション終了。                              | `resources/views/layouts/app.blade.php`, `<x-shared.overlays.modal name="confirm-logout">`                                                          |

## 画面一覧

| 画面              | Blade ファイル                                               | 説明                                                       |
| ----------------- | ------------------------------------------------------------ | ---------------------------------------------------------- |
| `top`             | `resources/views/pages/top/index.blade.php`                  | ログアウト時のランディング/紹介ページ。                    |
| `register`        | `resources/views/pages/auth/register/index.blade.php`        | 氏名・メール・パスワードを入力して新規アカウントを作成。   |
| `login`           | `resources/views/pages/auth/login/index.blade.php`           | メールアドレス + パスワードのログインフォーム。            |
| `forgot-password` | `resources/views/pages/auth/forgot-password/index.blade.php` | メールアドレスを送信し、パスワードリセット用リンクを取得。 |
| `reset-password`  | `resources/views/pages/auth/reset-password/index.blade.php`  | リセットリンク経由でアクセスし、新しいパスワードを設定。   |
| `index`           | `resources/views/pages/todo/index.blade.php`                 | ToDo 一覧、ソート UI、新規作成モーダルのトリガー。         |
| `user`            | `resources/views/pages/user/index.blade.php`                 | プロフィール表示/更新と、パスワード変更フォーム。          |
| 共通レイアウト    | `resources/views/layouts/app.blade.php`                      | ヘッダー、ログアウト確認モーダル、テーマ設定など。         |

## 開発環境

-   PHP 8.2+
-   Composer 2.x
-   Node.js 18+ / npm 9+
-   DB: MySQL (Laravel Sail のデフォルト)

## セットアップ手順

### 1. リポジトリ取得

```bash
git clone <このリポジトリのURL>
cd laravel-todo-app
```

### 2. 依存関係インストール

```bash
composer install
npm install
```

### 3. `.env` 作成と環境設定

-   Laravel Sail を `./vendor/bin/sail up` で初回起動すると `.env` が自動生成されます。すでに存在する場合は本手順をスキップしてください。
-   手動で環境構築する場合のみ以下を実行します。
    -   macOS/Linux:
        ```bash
        cp .env.example .env
        ```
    -   Windows (PowerShell):
        ```powershell
        Copy-Item .env.example .env
        ```

#### DB 設定について

-   **MySQL（Sail デフォルト）**: `.env` の `DB_CONNECTION=mysql` などは Sail が自動で書き換えるため、そのまま利用できます。

#### 開発中のメール送信（Mailpit）

-   Sail には Mailpit コンテナを追加済みです。`.env` が以下の値になっているか確認し、異なる場合は書き換えてください。

    ```env
    MAIL_MAILER=smtp
    MAIL_HOST=mailpit
    MAIL_PORT=1025
    MAIL_USERNAME=null
    MAIL_PASSWORD=null
    MAIL_ENCRYPTION=null
    MAIL_FROM_ADDRESS="hello@example.com" #任意のアドレス
    MAIL_FROM_NAME="${APP_NAME}"
    ```

-   `npm run up`（=`sail up`）実行中は [http://localhost:8025](http://localhost:8025) で送信済みメールを確認できます。パスワードリセットなどの通知はすべて Mailpit に保存されます。

### 4. アプリケーションキーの生成

```bash
php artisan key:generate
```

### 5. マイグレーション

```bash
php artisan migrate
```

### 6. アプリの起動 / 停止

```bash
npm run up      # 起動 (エイリアス指定 ./vendor/bin/sail up -d && npm run dev を実行)
npm run down    # 停止 (エイリアス指定 ./vendor/bin/sail down を実行)
```

ブラウザで `http://localhost` にアクセスするとアプリを確認できます。Mailpit のダッシュボードは `http://localhost:8025` です。
