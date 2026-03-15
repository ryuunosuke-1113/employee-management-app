# 社員管理アプリ（Employee Management App）

Laravel + Docker を使用して開発した社員管理システムです。
未経験エンジニア転職用のポートフォリオとして作成しました。

総務・人事部門で使用される社員管理システムを想定し、
社員情報と部署情報を管理できるWebアプリケーションになっています。

---

# アプリ概要

社員情報の登録・編集・削除・検索を行える管理システムです。
部署ごとの社員管理も可能です。

ダッシュボードでは社員数・部署数を確認でき、
最近追加された社員も表示されます。

---

# 主な機能

### 社員管理

・社員一覧表示
・社員登録
・社員編集
・社員削除
・社員詳細ページ

### 部署管理

・部署一覧表示
・部署登録
・部署編集
・部署削除

※社員が所属している部署は削除できないよう制御

### 検索機能

・社員名検索
・部署検索

### その他機能

・ページネーション
・バリデーション
・フラッシュメッセージ
・削除確認ダイアログ
・ダッシュボード
・Seeder（テストデータ）

---

# 使用技術

| 技術           | 内容         |
| ------------ | ---------- |
| PHP          | バックエンド     |
| Laravel      | Webフレームワーク |
| MySQL        | データベース     |
| Docker       | 開発環境       |
| Blade        | テンプレート     |
| Tailwind CSS | UIデザイン     |

---

# 開発環境

* WSL2 (Ubuntu)
* Docker
* Laravel
* MySQL

Dockerコンテナ内でLaravelを実行しています。

---

# データベース設計

## departments

| column     | type      |
| ---------- | --------- |
| id         | bigint    |
| name       | string    |
| created_at | timestamp |
| updated_at | timestamp |

## employees

| column        | type      |
| ------------- | --------- |
| id            | bigint    |
| name          | string    |
| email         | string    |
| department_id | bigint    |
| created_at    | timestamp |
| updated_at    | timestamp |

### リレーション

Department
hasMany → Employee

Employee
belongsTo → Department

---

# 画面構成

ダッシュボード
社員一覧
社員詳細
社員登録
社員編集
部署一覧
部署登録
部署編集

---

# セットアップ方法

```bash
git clone https://github.com/xxxxx/employee-management-app
cd employee-management-app
```

Docker起動

```bash
docker compose up -d
```

コンテナに入る

```bash
docker compose exec app bash
```

Laravelセットアップ

```bash
composer install
cp .env.example .env
php artisan key:generate
php artisan migrate --seed
```

アプリ起動

```bash
php artisan serve --host=0.0.0.0 --port=8000
```

ブラウザ

```
http://localhost:8000
```

---

# 今後の改善予定

・ログイン機能
・権限管理
・CSV出力
・ソート機能

---

# 開発目的

Laravelの基礎理解を目的として開発しました。

・CRUD処理
・リレーション
・検索機能
・ページネーション
・UI設計

などを実装しています。

---

# 作者

内藤 竜飛
