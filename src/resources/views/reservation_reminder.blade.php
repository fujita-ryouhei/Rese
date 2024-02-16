<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>予約リマインダー</title>
</head>
<body>
    <h1>予約リマインダー</h1>
    <p>以下の予約が今日あります。</p>
    <p>予約日時: {{ $reservation->date }}</p>
    <p>予約時間: {{ $reservation->time }}</p>
    <p>予約店舗: {{ $reservation->shop->name }}</p>
</body>
</html>