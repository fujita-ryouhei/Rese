<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Rese</title>
    <link rel="stylesheet" href="{{ asset('css/sanitize.css') }}">
    <link rel="stylesheet" href="{{ asset('css/mypage.css') }}">
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

    <main>
        <div class="contents">
            <div class="contents-ttl">
                <h2 class="user-name">{{ $user->name }}さん</h2>
            </div>
            <div class="contents-card flex">
                <div class="contents-card_reservation">
                    <h3 class="contents-card_reservation--ttl">予約状況</h3>
                    @if($reservations !== null && count($reservations) > 0)
                        @foreach($reservations as $reservation)
                            <div class="card-content">
                                <div class="card-content_ttl flex">
                                    <i class="fa-solid fa-clock fa-lg icon clock"></i>
                                    <h4>予約{{ $loop->iteration }}</h4>
                                    <form class="delete-form" action="/todos/delete" method="POST">
                                        @method('DELETE')
                                        @csrf
                                        <i class="fa-regular fa-circle-xmark icon x-mark"></i>
                                        <input type="hidden" name="shop_id" value="{{ $reservation->id }}">
                                    </form>
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
                                    <p>{{ $reservation->number_of_people }}</p>
                                </div>
                            </div>
                        @endforeach
                    @else
                        <p>予約がありません</p>
                    @endif
                </div>

                <div class="contents-card_favorite">
                    <h3 class="contents-card_favorite--ttl">お気に入り店舗</h3>
                    <div class="flex__item">
                        <div class="card">
                            <div class="card__img">
                                <img src="https://coachtech-matter.s3-ap-northeast-1.amazonaws.com/image/sushi.jpg" alt="" />
                            </div>
                            <div class="card__content">
                                <div class="card__content-cat">仙人</div>
                                <div class="card__content-tag">
                                    <p class="card__content-tag-item">#東京都</p>
                                    <p class="card__content-tag-item">#寿司</p>
                                </div>
                                <div class="card__content-detail">詳しくみる</div>
                            </div>
                        </div>

                        <div class="card">
                            <div class="card__img">
                                <img src="https://coachtech-matter.s3-ap-northeast-1.amazonaws.com/image/yakiniku.jpg" alt="" />
                            </div>
                            <div class="card__content">
                                <div class="card__content-cat">仙人</div>
                                <div class="card__content-tag">
                                    <p class="card__content-tag-item">#東京都</p>
                                    <p class="card__content-tag-item">#寿司</p>
                                </div>
                                <div class="card__content-detail">詳しくみる</div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </main>
</body>
</html>