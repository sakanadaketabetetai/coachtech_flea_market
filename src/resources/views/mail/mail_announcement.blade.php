<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>アナウンスメール</title>
    <link rel="stylesheet" href="{{ asset('css/mail_announcement.css') }}">
</head>
</head>
<body class="announcement-email">
    <div class="announcement-email__container">
        <!-- ヘッダー -->
        <div class="announcement-email__header">
            {{ $subjectText }}
        </div>

        <!-- 本文 -->
        <div class="announcement-email__content">
            <p>{{ $content }}</p>
        </div>

        <!-- フッター -->
        <div class="announcement-email__footer">
            このメールは自動送信です。ご質問がある場合は、<a href="mailto:support@example.com">support@example.com</a>までご連絡ください。
        </div>
    </div>
</body>
</html>
</html>
