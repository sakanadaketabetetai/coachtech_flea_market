<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
    <title>COACHTECH</title>
    @yield('css')
</head>
<body>
    <header class="header">
        <div class="header__container">
            <div class="header__logo">
                <a href="/">
                    <img src="/storage/images/logo.svg" alt="COACHTECHロゴ" class="header__logo-img">
                </a>
            </div>
            <div class="header__search">
                <form action="/search" method="get" id="searchForm">
                    @csrf
                    <input type="text" class="header__search-input" name="keyword" placeholder="商品を検索" oninput="document.getElementById('searchForm').submit();">
                </form>
            </div>
            <div class="header__nav">
                @if( Auth::check() )
                    <div class="header__nav-item">
                        <form action="/logout" method="POST">
                            @csrf
                            <button class="header__nav-button">ログアウト</button>
                        </form>
                    </div>
                    <div class="header__nav-item">
                        <a href="/mypage" class="header__nav-link">マイページ</a>
                    </div>
                @else
                    <div class="header__nav-item">
                        <a href="/login" class="header__nav-link">ログイン</a>
                        <a href="/register" class="header__nav-link">会員登録</a>
                    </div>
                @endif
                <div class="header__nav-item">
                    <form action="/sell" method="get">
                        @csrf
                        <button class="header__nav-button--sell">出品</button>
                    </form>
                </div>
            </div>
        </div>
    </header>
    <main class="main-content">
        <div class="main-content__container">
            @yield('content')
        </div>
    </main>
</body>
</html>