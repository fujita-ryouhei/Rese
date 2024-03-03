# Rese
店舗予約アプリケーション
![alt text](image.png)
## 作成した目的
お客様と店舗の間で円滑に、かつ正確に予約が出来るようにするため。

## アプリケーションURL
http://13.114.159.167/login

## 機能一覧
- 会員登録
- ログイン
- ログアウト
- ユーザー情報取得
- ユーザー飲食店お気に入り一覧取得
- ユーザー飲食店予約情報取得
- 飲食店一覧取得
- 飲食店詳細取得
- 飲食店お気に入り追加
- 飲食店お気に入り削除
- 飲食店予約情報追加
- 飲食店予約情報削除
- エリアで検索する
- ジャンルで検索する
- 店名で検索する

## 使用技術(実行環境)
- Laravel 8.83.27
- PHP 8.1
- mysql 8.0.26

## テーブル設計
![alt text](image-1.png)

## ER図
<img src="index.drawio.png">

# 環境構築# Rese
$ git clone git@github.com:fujita-ryouhei/Rese.git

続いてDockerの設定を行なっていきます。以下のコマンドを入力してください。<br>
$ docker-compose up -d --build<br>
実行が終わったら、「Docker Desktop for Mac」を確認して、コンテナが作成されていれば成功です。<br><br>

次にdocker-composeコマンドで PHPコンテナ内にログインしましょう。<br>
docker-compose exec php bash <br>
ログインができたら、composerコマンドを使って必要なパッケージをインストールします。<br>
composer install<br><br>

最後に、データベースに接続するために.envファイルを作成します。<br>
.envファイルは、.env.exampleファイルをコピーして作成しましょう。<br>
$ cp .env.example .env<br>
作成出来たら、.envファイルを以下のように編集します。<br><br>
.envファイル<br><br>
// 前略<br><br>
DB_CONNECTION=mysql<br>
DB_HOST=mysql<br>
DB_PORT=3306<br>
DB_DATABASE=laravel_db<br>
DB_USERNAME=laravel_user<br>
DB_PASSWORD=laravel_pass<br><br>
// 後略<br><br>

以下のアドレスに入るとデータベースが存在しているか確認ができます。

http://localhost:8080/<br>

確認出来たらマイグレーションをします。<br>
php artisan migrate <br>
最後にシーディングをします。<br>
php artisan db:seed<br>

以上で環境構築は完了です。<br><br>