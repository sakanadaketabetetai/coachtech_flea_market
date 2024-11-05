<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="{{ asset('css/admin_layout.css') }}">
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
                <input type="text" class="header__search-input" placeholder="なにをお探しですか？">
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
                        <button class="header__nav-button header__nav-button--sell">出品</button>
                    </form>
                </div>
            </div>
        </div>
    </header>
    <main>
        <div class="admin-dashboard">
            <!-- サイドメニュー -->
            <nav class="admin-dashboard__sidebar">
                <div class="admin-dashboard__menu-title">
                    管理メニュー
                </div>
                <ul class="admin-dashboard__menu-list">
                    <li class="admin-dashboard__menu-item">
                        <a href="/admin/user" class="admin-dashboard__menu-link">ユーザー一覧</a>   
                    </li>
                    <li class="admin-dashboard__menu-item">
                        <a href="/admin/comment" class="admin-dashboard__menu-link">コメント一覧</a>
                    </li>
                </ul>
            </nav>
            <div class="admin-dashboard__content">
                @yield('content')
            </div>
        </div>
    </main>
</body>
</html>