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

それらの課題を少しでも解決できるよう、  
検索・絞り込み・権限制御・CSV出力など、実務を意識した機能を備えた社員管理システムを開発しました。

---

## 🛠 技術スタック

- Laravel / PHP
- MySQL
- Docker（nginx / php / mysql）
- Blade / Tailwind CSS

---

## ⚙️ 主な機能

### ■ 社員管理機能
- 社員情報の一覧表示
- 社員情報の登録
- 社員情報の詳細表示
- 社員情報の編集
- 社員情報の削除
- 氏名・メールによる検索
- 部署・ステータスによるフィルタ
- カラムクリックによる並び替え
- ページネーション

### ■ 部署管理機能
- 部署情報の一覧表示
- 部署情報の登録
- 部署情報の編集
- 部署情報の削除
- 社員が紐づいている部署は削除不可

### ■ 認証・権限管理
- Laravel Breezeによるログイン認証
- 管理者：admin はCRUD操作可能
- 一般ユーザー：閲覧のみ可能
- Policy / authorize / Bladeの@can による制御

### ■ CSV出力
- 検索・フィルタ状態を維持したまま出力
- BOM付きでExcel文字化け対策

### ■ ダッシュボード機能
- 社員数の表示（総数・在籍・休職・退職）
- 部署数の表示
- 最近入社した社員一覧の表示
- 各画面への導線を配置

---

## 💡 工夫した点

### 1. 実務を意識したデータ整合性
部署に社員が紐づいている場合は削除できないようにし、  
実務システムとしての安全性を意識しました。

### 2. 権限管理を多層で実装
Policy、Controllerのauthorize、Bladeの@canを組み合わせ、  
画面表示とバックエンドの両方で制御を行いました。

### 3. 検索・フィルタ・並び替え処理を整理
`buildEmployeeQuery` に検索・フィルタ処理を集約し、  
可読性・保守性を意識してリファクタリングしました。

### 4. CSV出力の実用性を意識
検索・絞り込み結果をそのままCSV出力できるようにし、  
実務で使いやすい仕様を意識しました。

### 5. UI/UXの改善
- フラッシュメッセージの表示
- ステータスの色分け
- 操作しやすい導線配置

など、利用者にとって分かりやすい画面を意識しました。

---

## 📸 スクリーンショット

### ダッシュボード
![ダッシュボード](images/dashboard.png)

### 社員一覧
![社員一覧](images/employees.png)

### 社員登録画面
![社員登録](images/employee-create.png)

### 部署一覧
![部署一覧](images/departments.png)

---

## 🚀 ローカル起動方法

```bash
git clone https://github.com/ryuunosuke-1113/employee-management-app.git
cd employee-management-app
docker compose up -d
docker compose exec php composer install
docker compose exec php cp .env.example .env
docker compose exec php php artisan key:generate
docker compose exec php php artisan migrate --seed
```


## 🔑 テスト用アカウント

ログインして動作確認ができます。

| 権限 | メール | パスワード |
|------|--------|-----------|
| 管理者 | admin@example.com | password |
| 一般ユーザー | user@example.com | password |

※ 管理者アカウントでログインすると、登録・編集・削除機能を利用できます。
※ 一般ユーザーは閲覧のみ可能です。

## 📂 ディレクトリ構成（一部）
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
デプロイの安定化
テストコードの追加
UIの改善
READMEや設計意図のさらなる整理
## 想定利用者
社員情報を管理したい企業
社員一覧や所属部署を管理したい総務・人事担当者
権限ごとに操作を分けたい業務システム利用者
## 📘 補足

このアプリは、未経験エンジニア転職用のポートフォリオとして制作しました。
現職での人事総務業務の経験をもとに、
「実務で使われることを意識したシステム開発」をテーマにしています。

## 💼 アピールポイント

現職の人事総務業務での課題をもとに設計しており、  
単なるCRUDアプリではなく、実務での利用を意識した機能・制約を実装しています。