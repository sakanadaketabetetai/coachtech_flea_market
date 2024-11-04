<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>注文完了メール</title>
</head>
<body style="font-family: Arial, sans-serif; color: #333; line-height: 1.6;">
    <div class="email-container" style="max-width: 600px; margin: 0 auto; padding: 20px; background-color: #f9f9f9;">
        <div class="email-header" style="text-align: center; margin-bottom: 20px;">
            <h4 style="margin: 0; font-size: 18px;">注文完了メール</h4>
            <h4 style="margin: 0; font-size: 14px; color: #888;">(本メールは送信専用メールです。※返信不可)</h4>
        </div>
        <div class="email-body" style="background-color: #fff; padding: 20px; border-radius: 5px;">
            <div class="email-greeting" style="margin-bottom: 20px;">
                <p style="margin: 0; font-size: 16px;">{{ $user->name }} 様</p>
            </div>
            <div class="email-message" style="margin-bottom: 20px;">
                <p style="margin: 0; font-size: 16px;">いつもお世話になっております。</p>
                <p style="margin: 0; font-size: 16px;">{{ $item->item_name}}の注文が完了しました。</p>
                <p style="margin: 0; font-size: 16px;">支払い方法は{{ $order->payment_method }}となっております。</p>
                <p style="margin: 0; font-size: 16px;">振込先は下記の通りとなりますので、1週間以内に振り込みをお願いします。</p>
            </div>
            <div class="email-action" style="margin-bottom: 20px;">
                <p style="margin: 0; font-size: 16px;">ご注文内容の確認につきましては、「coachtechフリマ」より、対象のご予約のご確認をお願いいたします。</p>
                <a href="http://localhost" target="_blank" style="color: #3498db; text-decoration: none; font-size: 16px;">http://localhost</a>
                <p style="margin: 0; font-size: 14px; color: #888;">※ログインが必要です。</p>
            </div>
            <div class="email-details">
                <table style="width: 100%; border-collapse: collapse;">
                    <tr style="border-bottom: 1px solid #ddd;">
                        <th style="text-align: left; padding: 8px;">購入品名</th>
                        <td style="padding: 8px;">{{ $item->item_name }}</td>
                    </tr>
                    <tr style="border-bottom: 1px solid #ddd;">
                        <th style="text-align: left; padding: 8px;">金額</th>
                        <td style="padding: 8px;">￥ {{ $order->amount }} 円</td>
                    </tr>
                </table>
            </div>
        </div>
    </div>
</body>
</html>
