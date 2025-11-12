@php
    $accent = '#f43f5e';
@endphp

<!DOCTYPE html>
<html lang="ja">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>パスワード再設定 | Todin</title>
</head>

<body style="margin:0;padding:0;background-color:#f4f4f5;font-family:'Helvetica Neue',Helvetica,Arial,'Hiragino Kaku Gothic ProN',Meiryo,sans-serif;color:#0f172a;">
    <table role="presentation" width="100%" cellspacing="0" cellpadding="0" style="background-color:#f4f4f5;padding:32px 12px;">
        <tr>
            <td align="center">
                <table role="presentation" width="100%" cellspacing="0" cellpadding="0" style="max-width:640px;background-color:#ffffff;border-radius:24px;box-shadow:0 25px 60px rgba(15,23,42,0.08);overflow:hidden;">
                    <tr>
                        <td style="padding:32px;">
                            <p style="margin:0;font-size:12px;letter-spacing:0.4em;text-transform:uppercase;font-weight:600;color:{{ $accent }};">
                                Todin
                            </p>
                            <h1 style="margin:8px 0 0;font-size:28px;color:#0f172a;">パスワード再設定</h1>
                            <p style="margin:16px 0 0;font-size:14px;line-height:1.7;color:#475569;">
                                {{ $user->name }} 様<br>
                                パスワード再設定のリクエストを受け付けました。以下のボタンから新しいパスワードを設定してください。リンクの有効期限は {{ $expire }} 分です。
                            </p>
                            <table role="presentation" cellspacing="0" cellpadding="0" style="margin:28px 0;">
                                <tr>
                                    <td>
                                        <a href="{{ $url }}" style="display:inline-block;padding:14px 36px;border-radius:999px;background-color:{{ $accent }};color:#ffffff;font-weight:600;font-size:15px;text-decoration:none;">
                                            パスワードを再設定
                                        </a>
                                    </td>
                                </tr>
                            </table>
                            <p style="margin:0;font-size:13px;line-height:1.7;color:#475569;">
                                上記ボタンが機能しない場合は、次の URL をブラウザに貼り付けてください。<br>
                                <a href="{{ $url }}" style="color:{{ $accent }};text-decoration:none;">{{ $url }}</a>
                            </p>
                            <hr style="border:none;border-top:1px solid #e2e8f0;margin:32px 0;">
                            <p style="margin:0;font-size:12px;color:#94a3b8;line-height:1.7;">
                                このメールに心当たりがない場合は破棄してください。アカウントの安全のため、パスワードを他サイトと使い回さないことをおすすめします。
                            </p>
                        </td>
                    </tr>
                </table>
                <p style="margin-top:24px;font-size:11px;color:#94a3b8;">&copy; {{ date('Y') }} Todin</p>
            </td>
        </tr>
    </table>
</body>

</html>
