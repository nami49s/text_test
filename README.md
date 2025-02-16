# お問い合せフォーム

## 環境構築
以下の手順でDockerのビルドからマイグレーション、シーディングまでを実行します。

# Dockerビルド
1. git@github.com:nami49s/text_test.git
2. docker-compose up -d build

* MySQLは、OSによって起動しない場合があるのでそれぞれのPCに合わせて docker-compose.ymlファイルを編集してください。

# Laravel環境構築
1. docker-compose exec php bash
2. composer install
3. .env.exampleファイルから.envを作成し、環境変数を変更
4. php artisan key:generate
5. php artisan migrate
6. php artisan db:seed

## 使用技術
_ PHP 7.4.9
_ Laravel 8.83.29
_ mysql 9.1.0

## ER図
![ER図](https://raw.githubusercontent.com/nami49s/text_test/0dc2fa1418d20f1ac36f5dc8775e1569673dc0f0/contact_form.png)

## URL
_ 開発環境:http://localhost/
_ phpMyAdmin:http://localhost:8080/