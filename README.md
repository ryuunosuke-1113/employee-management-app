# 社員管理システム（Employee Management System）

Laravelを用いて開発した社員管理システムです。
社員情報・部署情報の一元管理を目的とし、実務での利用を想定して開発しました。

---
## 📌 概要

現職でExcelによる人事データ管理に携わる中で、

- 入力ミス
- 集計の手間
- 情報の分散
- 権限管理の難しさ

といった課題を感じていました。

これらの課題を解決するために、
検索・絞り込み・権限制御・CSV出力などの機能を備えた社員管理システムを開発しました。

---


## 🎯 このアプリの特徴（ここ見てほしい）
- Dockerによる環境構築の自動化（第三者が再現可能）
- 検索・フィルタ・並び替えの実装
- Policyによる権限管理（admin / user）
- CSV出力（Excel文字化け対策済み）
- 実務を意識したデータ整合性制御（部署削除制限）
## 🛠 技術スタック
- Laravel / PHP
- MySQL
- Docker（nginx / php / mysql）
- Blade / Tailwind CSS
## ⚙️ 主な機能
- 社員管理
- 一覧 / 登録 / 詳細 / 編集 / 削除
- 検索（氏名・メール）
- フィルタ（部署・ステータス）
- 並び替え（カラムクリック）
- ページネーション
- 部署管理
- 一覧 / 登録 / 編集 / 削除
社員が紐づく部署は削除不可
## 認証・権限
- Laravel Breezeによる認証
- 管理者：admin → CRUD可能
- 一般ユーザー：閲覧のみ
- Policy + authorize + Blade(@can) による多層制御
- CSV出力
  - 検索条件を維持したまま出力
  - BOM付き（Excel対応）
- ダッシュボード
  - 社員数（総数・在籍・休職・退職）
  - 部署数
  - 最近入社した社員一覧
# 工夫した点
- データ整合性

  - 部署に社員が存在する場合は削除できないようにし、
実務システムとしての安全性を担保しました。

  - 権限制御の徹底

    - Policy / Controller / Blade の3層で制御し、
UIとバックエンドの両方で安全性を確保しました。

  - 検索ロジックの整理

    - buildEmployeeQuery に処理を集約し、
可読性・保守性を向上させました。

  - 実務を意識したCSV出力

    - フィルタ結果をそのまま出力可能にし、
業務で使いやすい仕様にしました。

## 📸 スクリーンショット

### ダッシュボード
![ダッシュボード](images/dashboard.png)

### 社員一覧
![社員一覧](images/employees.png)

### 社員登録画面
![社員登録](images/create.png)

### 部署一覧
![部署一覧](images/departments.png)

## 🚀 ローカル起動方法

### 前提
- Docker Desktop がインストールされていること

### セットアップ手順

```bash
git clone https://github.com/ryuunosuke-1113/employee-management-app.git
cd employee-management-app
docker compose up -d --build
```

- 初回起動時に自動実行される処理
  - composer install
  - .env 作成
  - アプリキー生成
  - マイグレーション / シーディング
  - フロントビルド
## アクセス
- アプリ：http://localhost:8080
- phpMyAdmin：http://localhost:8081
## テスト用アカウント
| 権限 | メール | パスワード |
|------|--------|-----------|
| 管理者 | admin@example.com | password |
| 一般ユーザー | user@example.com | password |
	
## 🧯 トラブルシューティング
- コンテナ確認
  - docker compose ps

- ログ確認
  - docker compose logs -f

- 再構築
  - docker compose down -v<br>
docker compose up -d --build

- フロント再ビルド
  - docker compose exec php npm run build

- 権限エラー
  - docker compose exec php chmod -R 775 storage bootstrap/cache

- DB確認
  - docker compose logs mysql
## 📂 ディレクトリ構成

```bash
app/
├── Http/Controllers/
├── Models/
├── Policies/

resources/views/
├── employees/
├── departments/
├── dashboard.blade.php

database/
├── migrations/
├── seeders/

docker/
├── nginx/
├── php/
```

## 🎯 今後の課題
- デプロイの安定化
- テストコード追加
- UI改善
## 💼 アピールポイント

現職の人事総務業務の課題をもとに設計しており、
単なるCRUDではなく、実務利用を前提とした設計・制約を実装しています。