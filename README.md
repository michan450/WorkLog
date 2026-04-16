# 勤怠管理アプリ

## 概要

このアプリは、従業員の出退勤を管理するための勤怠管理アプリです。
ユーザーは出勤・退勤の打刻や勤怠情報の確認ができ、管理の効率化を目的としています。
認証機能にはLaravel Fortifyを使用しています。

---

## 主な機能

* ユーザー登録・ログイン（Laravel Fortify）
* 出勤・退勤打刻機能
* 勤怠一覧表示
* 勤怠詳細確認
* マイページ機能

---

## 使用技術

・PHP 8.1-fpm
・Laravel 10.50.2
・MySQL 8.0.26
・Nginx 1.21.1

---

## 環境構築

### ① リポジトリをクローン

```bash
git clone https://github.com/michan450/WorkLog.git

```

### ② Docker起動

```bash
docker compose up -d --build
```

### ③ Laravel設定

```bash
docker compose exec php composer install
docker compose exec  cp .env.example .env
※ .envのDB設定などを適宜変更してください

php artisan key:generate
php artisan migrate
php artisan db:seed
```

### ⑤ アクセス

http://localhost

---

## ER図

（ここにER図を追加予定）



