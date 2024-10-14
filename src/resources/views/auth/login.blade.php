@extends('layouts.app')

@section('css')
    <link rel="stylesheet" href="{{ asset('css/login.css') }}">
@endsection

@section('content')
<div class="login">
    <div class="login_title">
        <h2 class="login_title-text">ログイン</h2>
    </div>
    <form action="/login" method="post">
        @csrf
        <div class="login_content">
            <div class="login_input-group">
                <div class="login_input-title">
                    <h3 class="login_input-title--text">メールアドレス</h3>
                </div>
                <div class="login_input">
                    <input type="email" name="email" >
                </div>
            </div>
            <div class="login_input-group">
                <div class="login_input-title">
                    <h3 class="login_input-title--text">パスワード</h3>
                </div>
                <div class="login_input">
                    <input type="password" name="password" >
                </div>
            </div>
        </div>
        <div class="login_button">
            <button class="login_button-submit">ログインする</button>
        </div>
    </form>
    <div class="login_link">
        <a href="/register" class="login_link-text">会員登録はこちら</a>
    </div>
</div>
@endsection