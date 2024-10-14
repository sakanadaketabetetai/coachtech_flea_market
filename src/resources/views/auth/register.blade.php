@extends('layouts.app')

@section('css')
    <link rel="stylesheet" href="{{ asset('css/register.css') }}">
@endsection

@section('content')
<div class="register">
    <div class="register_title">
        <h2 class="register_title-text">会員登録</h2>
    </div>
    @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif
    <form action="/register" method="post">
        @csrf
        <div class="register_content">
            <div class="register_input-group">
                <div class="register_input-title">
                    <h3 class="register_input-title--text">メールアドレス</h3>
                </div>
                <div class="register_input">
                    <input type="email" name="email">
                </div>
            </div>
            <div class="register_input-group">
                <div class="register_input-title">
                    <h3 class="register_input-title--text">パスワード</h3>
                </div>
                <div class="register_input">
                    <input type="password" name="password">
                </div>
            </div>
        </div>
        <div class="register_button">
            <button class="register_button-submit">会員登録する</button>
        </div>
    </form>
    <div class="register_link">
        <a href="/login" class="register_link-text">ログインはこちら</a>
    </div>
</div>
@endsection
