<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>予約確認メール</title>
</head>
<body style="font-family: Arial, sans-serif; color: #333; line-height: 1.6;">
    <div class="email-container" style="max-width: 600px; margin: 0 auto; padding: 20px; background-color: #f9f9f9;">
        <div class="email-header" style="text-align: center; margin-bottom: 20px;">
            <h4 style="margin: 0; font-size: 18px;">▼予約1日前確認メール</h4>
            <h4 style="margin: 0; font-size: 14px; color: #888;">(本メールは送信専用メールです。※返信不可)</h4>
        </div>
        <div class="email-body" style="background-color: #fff; padding: 20px; border-radius: 5px;">
            <div class="email-greeting" style="margin-bottom: 20px;">
                <p style="margin: 0; font-size: 16px;">{{ $user->name }} 様</p>
            </div>
            <div class="email-message" style="margin-bottom: 20px;">
                <p style="margin: 0; font-size: 16px;">いつもお世話になっております。{{ $store->store_name }} です。</p>
                <p style="margin: 0; font-size: 16px;">こちらのメールはご予約1日前にご予約内容確認のために配信させていただいております。</p>
            </div>
            <div class="email-action" style="margin-bottom: 20px;">
                <p style="margin: 0; font-size: 16px;">ご予約詳細の確認・変更・キャンセルにつきましては、「Rese mypage」より、対象のご予約のご確認をお願いいたします。</p>
                <a href="http://localhost" target="_blank" style="color: #3498db; text-decoration: none; font-size: 16px;">http://localhost</a>
                <p style="margin: 0; font-size: 14px; color: #888;">※ログインが必要です。</p>
            </div>
            <div class="email-details">
                <table style="width: 100%; border-collapse: collapse;">
                    <tr style="border-bottom: 1px solid #ddd;">
                        <th style="text-align: left; padding: 8px;">予約店舗</th>
                        <td style="padding: 8px;">{{ $store->store_name }}</td>
                    </tr>
                    <tr style="border-bottom: 1px solid #ddd;">
                        <th style="text-align: left; padding: 8px;">予約日</th>
                        <td style="padding: 8px;">{{ $reservation->reservation_day }}</td>
                    </tr>
                    <tr style="border-bottom: 1px solid #ddd;">
                        <th style="text-align: left; padding: 8px;">予約時間</th>
                        <td style="padding: 8px;">{{ $reservation->reservation_time }}</td>
                    </tr>
                    <tr style="border-bottom: 1px solid #ddd;">
                        <th style="text-align: left; padding: 8px;">予約人数</th>
                        <td style="padding: 8px;">{{ $reservation->number_of_people }} 人</td>
                    </tr>
                </table>
            </div>
        </div>
    </div>
</body>
</html>
