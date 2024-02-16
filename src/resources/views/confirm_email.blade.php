<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>メール確認</title>
</head>
<body>
    <p>以下のリンクをクリックしてメールを確認してください。</p>
    <a href="{{ route('confirm.email', $user->confirmation_token) }}">メールを確認する</a>
</body>
</html>