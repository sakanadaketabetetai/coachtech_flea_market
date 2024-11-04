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
### coachtech_flea_market table図
![coachtech_flea_market](https://github.com/user-attachments/assets/92adad85-1d8a-4ef3-a18f-be12af0c8c5f)
### laravel_permission table図
![laravel_permission](https://github.com/user-attachments/assets/be7b1173-d530-42dd-8dbc-31440965ced2)

## ER図
### coachtech_flea_market er図
![coachtech_flea_market](https://github.com/user-attachments/assets/92adad85-1d8a-4ef3-a18f-be12af0c8c5f)
### laravel_permission er図 (laravel Permissionパッケージ)
![laravel_permission](https://github.com/user-attachments/assets/be7b1173-d530-42dd-8dbc-31440965ced2)

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
1. 「coachtechフリマ」サイトにアクセスします。

2. 検索欄に商品名を入力すると該当する商品が表示されます。

3. 商品カードをクリックすると、商品詳細画面が表示される。

### 会員登録及びログイン後
1. ログインすると商品の購入、お気に入り、コメント等の操作が可能です。

2. 商品詳細画面内の「💭」をクリックすると、コメント画面へ移行し、コメントが可能です。

3. 商品詳細画面内の「★」をクリックすると、お気に入りに登録
   されます。再度クリックすると、解除されます。

4. 商品詳細画面内の「購入する」をクリックすると、購入画面が表示され、支払い方法や発送先を指定し、購入が可能です。

5. 右上のマイページをクリックするとマイページ画面が表示され、出品商品一覧及び購入品一覧状況が確認できます。
   またマイページ内のプロフィール編集をクリックするとプロフィール編集画面へ移行し編集することができます。

6. マイページ内の販売実績及び販売状況をクリックすると、自身が出品した商品の注文状況が確認できます。
   銀行振込及びコンビニ支払いの場合は、自身で振り込み確認後、振込を確認をクリックすると注文確定します。

7. 注文後、注文メールが送信されます。（銀行振込及びコンビニ支払いの場合）

8. 会員登録する場合は、「氏名」、「メールアドレス」、「パスワード」を
　 入力し、入力したメールアドレスに確認メールが送信されます。



### 管理者権限
1. マイページ内の右上にある管理者画面をクリックすると、管理者画面が表示され
　 ユーザー情報やコメント一覧の確認ができます。アナウンスメール送信やコメントの
   削除が可能です。




