<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>アナウンスメール</title>
    <link rel="stylesheet" href="{{ asset('mail_announcement.css') }}">
</head>
<body class="announcement-email">
    <div class="announcement-email__container">
        <h1 class="announcement-email__title">お知らせ</h1>
        <p class="announcement-email__content">{{ $content }}</p>
    </div>
</body>
</html>