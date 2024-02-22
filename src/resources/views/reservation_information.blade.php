<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Rese</title>
    <link rel="stylesheet" href="{{ asset('css/sanitize.css') }}">
    <link rel="stylesheet" href="{{ asset('css/reservation_information.css') }}">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" integrity="sha512-iecdLmaskl7CVkqkXNQ/ZH/XLlvWZOJyj7Yy7tcenmpD1ypASozpmT/E0iPtmFIB46ZmdtAc9eNBvH0H/ZpiBw==" crossorigin="anonymous" referrerpolicy="no-referrer" />
</head>
<body>
    <header class="header">
        <div class="header-icon">
            <a href="/menu">
                <h1 class="header-icon_ttl"><i class="fa-solid fa-square-poll-horizontal fa-fw"></i>Rese</h1>
            </a>
        </div>
    </header>

    <div class="contents-card flex">
        <div class="contents-card_reservation">
            <h3 class="contents-card_reservation--ttl">予約状況</h3>
            @if($reservations !== null && count($reservations) > 0)
                @foreach($reservations as $reservation)
                    <div class="card-content">
                        <!-- 予約情報表示 -->
                        <div class="card-content_ttl flex">
                            <i class="fa-solid fa-clock fa-lg icon clock"></i>
                            <h4>予約{{ $loop->iteration }}</h4>
                        </div>
                        <div class="card-content_list flex">
                            <p>Shop</p>
                            <p>{{ $reservation->shop->name }}</p>
                        </div>
                        <div class="card-content_list flex">
                            <p>Date</p>
                            <p>{{ $reservation->date }}</p>
                        </div>
                        <div class="card-content_list flex">
                            <p>Time</p>
                            <p>{{ $reservation->time }}</p>
                        </div>
                        <div class="card-content_list flex">
                            <p>Number</p>
                            <p>{{ $reservation->number_of_people }}人</p>
                        </div>
                    </div>
                @endforeach
            @else
                <p>予約がありません</p>
            @endif
        </div>
    </div>
</body>
</html>