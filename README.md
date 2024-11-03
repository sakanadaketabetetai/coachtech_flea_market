# coachtechフリマ(フリマアプリ)

## 概要

このプロジェクトは、ユーザーが出品や出品物を購入することができるアプリケーションです。ユーザーは会員登録後、販売品の出品及び購入、クレジットカードによる決済、出品物の販売状況管理などを容易に行うことができます。

## 作成した目的
COACHTECHブランドのアイテムを出品したいため、独自のフリマアプリを作成した。

## アプリケーションURL
- coachtechフリマのURL : http://localhost  
  ※awsデプロイした場合は、http://AWSパブリックIPv4アドレス
- MailCatcherのURL : http://localhost:1080    
  ※awsデプロイした場合、http://AWSパブリックIPv4アドレス:1080
### 参考URL(awsにデプロイ)

## GitHubのリポジトリ
- https://github.com/sakanadaketabetetai/rese.git
　

## 機能一覧
### 全権限に共通する機能
- 会員登録機能 ( メール認証付 )
- ログイン及びログアウト機能
- ユーザープロフィール編集、ユーザー出品物の販売実績及び販売状況一覧情報取得
- 販売商品の詳細情報取得
- 販売商品のお気に入り登録機能
- 販売商品検索機能（商品名で検索可能）
### 管理者権限機能
- 登録しているユーザー情報一覧（削除、アナウンスメール機能付き）
- 販売商品へのコメント一覧及び削除機能

## 使用技術 ( 実行環境 )
- Docker 26.1.4
- Laravel 8.x
- php 7.4.9-fpm
- mysql 8.0.26
- mailcatcher ( メール認証機能確認用 )

## 特徴
- 販売商品の購入やクレジットカード決済が可能（その他に銀行振込、コンビニ決済可能）
- ユーザーは出品物の販売状況及び販売実績が可能予約や店舗情報の管理が可能
- 店舗代表者はお客様来店時にQRコードで予約情報の確認や来店手続きが可能
- 登録している店舗情報をジャンルやエリア、店名で検索が可能
- 管理者はユーザー情報及び店舗情報等の管理（権限変更や店舗代表者の追加等）が可能
- ユーザーフレンドリーなインターフェース

## テーブル設計
### rese table図
![rese_table](https://github.com/user-attachments/assets/f60c1b1f-7da0-41d9-8cb1-0b3b59f29f69)
### laravel_permission table図
![laravel_permission_table](https://github.com/user-attachments/assets/b63996ad-be02-4351-a1db-3df76a350579)

## ER図
### rese er図
![rese](https://github.com/user-attachments/assets/853e169a-0e74-4885-b690-08dc461b74b8)
### laravel_permission er図 (laravel Permissionパッケージ)
![laravel_permission](https://github.com/user-attachments/assets/1bc4c69c-6f57-46b9-b784-0edd494ddef3)

## 環境構築

### Dockerビルド

1. ```bash 
   git clone git@github.com:sakanadaketabetetai/rese.git
   ```
2. DockerDesktopアプリを立ち上げる
3. docker-compose up -d --build


### Laravel環境構築

1. PHPコンテナにアクセス:
    ```bash
    docker-compose exec php bash
    ```
2. 依存関係をインストールします:
    ```bash
    composer install
    ```
3. 環境変数ファイルをコピーします:
    ```bash
    cp .env.example .env
    ```
4. .envに以下の環境変数を追加
    Mysqlに関する設定
    ```bash
    DB_CONNECTION=mysql
    DB_HOST=mysql
    DB_PORT=3306
    DB_DATABASE=laravel_db
    DB_USERNAME=laravel_user
    DB_PASSWORD=laravel_pass
    ```
    メールに関する設定
    ※下の変数設定はMailCatcherを使用する場合の設定であり、自身のメールアドレスを使用する場合は、必要に応じて設定値を変更する
    ```bash
    MAIL_MAILER=smtp　　　　//メールドライバー
    MAIL_HOST=mailcatcher  //SMTPメールサーバーのホスト名を入力 
    MAIL_PORT=1025 //SMTPサーバーのポート番号を入力
    MAIL_USERNAME=null //SMTPサーバーにログインするために使用するユーザー名を入力
    MAIL_PASSWORD=null //SMTPサーバーにログインするために使用するパスワードを入力
    MAIL_ENCRYPTION=null //SMTPサーバーとの通信を暗号化
    MAIL_FROM_ADDRESS=no-reply@example.com //送信元のメールアドレス
    MAIL_FROM_NAME="${APP_NAME}" //送信者名
    ```
    APP環境
    ```bash
    APP_NAME=Laravel
    APP_ENV=local
    APP_KEY=　     //php artisan key:generate実行時に自動で生成される
    APP_DEBUG=true
    APP_URL=http://localhost //AWS ec2インスタンスにデプロイする場合、AWSパブリックIPv4アドレスを入力
    ```
    
5. アプリケーションキーを生成します:
    ```bash
    php artisan key:generate
    ```
6. マイグレーションを実行します:
    ```bash
    php artisan migrate
    ```
7. シーディングを実行
    ```bash
    php artisan db:seed  
    ```
    //準備しているMasterDatabaseSeeder.phpとStoreSeeder.phpの内容がデータベースに保存される


## 基本的な使い方

### 全権限共通
1. ログインしてダッシュボードにアクセスします。

2. 予約したい飲食店カード内の「詳しく見る」をクリックして、
　 店舗詳細画面を表示すると、レビューができ、また予約が可能です。

3. 予約したい飲食店カード内の「♥」をクリックすると、お気に入りに登録
   されます。再度クリックすると、解除されます。

4. 左上のアイコンをクリックするとメニュー画面が表示され、「Mypage」を
　 クリックすると、マイページ画面が表示され、予約状況やお気に入り
　 店舗が確認できます。ここで予約内容の変更やQRコード表示、決済が可能です。

5. 会員登録する場合は、「氏名」、「メールアドレス」、「パスワード」を
　 入力し入力したメールアドレスに確認メールが送信されます。

6. 予約前日にリマインドメールが送信されます。

### 管理者権限
1. 左上のアイコンをクリックするとメニュー画面が表示され、「Admin」を
　 クリックすると、管理者画面が表示され、ユーザー情報や店舗情報等の確認が
　 できます。アナウンスメール送信や店舗代表者を追加することができます。

### 店舗代表者権限
1. 左上のアイコンをクリックするとメニュー画面が表示され「Store_Owner
　 _Admin」をクリックすると、店舗代表者管理画面が表示され、予約情報や店舗
　 情報等の確認や編集ができます。また店舗情報を追加することができます。



