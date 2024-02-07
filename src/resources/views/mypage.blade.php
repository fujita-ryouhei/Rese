<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Rese</title>
    <link rel="stylesheet" href="{{ asset('css/sanitize.css') }}">
    <link rel="stylesheet" href="{{ asset('css/mypage.css') }}">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" integrity="sha512-iecdLmaskl7CVkqkXNQ/ZH/XLlvWZOJyj7Yy7tcenmpD1ypASozpmT/E0iPtmFIB46ZmdtAc9eNBvH0H/ZpiBw==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
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
                                    <form class="delete-form" action="/reservation/delete" method="POST">
                                        @method('DELETE')
                                        @csrf
                                        <input type="hidden" name="reservation_id" value="{{ $reservation->id }}">
                                        <button type="submit" class="delete-btn">
                                            <i class="fa-regular fa-circle-xmark icon x-mark"></i>
                                        </button>
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
                                    <p>{{ $reservation->number_of_people }}人</p>
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
                        @if ($favoriteShops->isNotEmpty())
                            @foreach($favoriteShops  as $shop)
                                @if($shop->isFavorited)
                                    <div class="card">
                                        <div class="card__img">
                                            <img src="{{ $shop->image_url }}" alt="" />
                                        </div>
                                        <div class="card__content">
                                            <div class="card__content-cat">{{ $shop->name }}</div>
                                            <div class="card__content-tag">
                                                <p class="card__content-tag-item">#{{ $shop->location }}</p>
                                                <p class="card__content-tag-item">#{{ $shop->category }}</p>
                                            </div>
                                            <a href="{{ route('detail.page', ['id' => $shop->id]) }}">
                                                <div class="card__content-detail">詳しくみる</div>
                                            </a>

                                            <!-- お気に入りボタン -->
                                            <button class="favorite-btn" data-shop-id="{{ $shop->id }}" data-original-index="{{ $loop->index }}">
                                                @csrf
                                                <i class="fa-solid fa-heart fa-2x" style="color: #c7c7c7;"></i>
                                            </button>
                                        </div>
                                    </div>
                                @endif
                            @endforeach
                        @else
                            <p>お気に入り店舗がありません</p>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </main>

    <script>
        // ページが読み込まれたときに実行される処理
        $(document).ready(function() {
            $('.favorite-btn').each(function() {
                var shopId = $(this).data('shop-id');
                var isFavorited = getFavoriteStatusSync(shopId);

                // ハートマークの色を設定
                if (isFavorited) {
                    $(this).find('i').addClass('heart-filled');
                } else {
                    $(this).find('i').removeClass('heart-filled');
                }

                // データ属性を更新
                $(this).data('is-favorited', isFavorited);
            });
        });

        // 同期的にお気に入りの状態を取得する関数
        function getFavoriteStatusSync(shopId) {
            var isFavorited = false;

            $.ajax({
                type: 'GET',
                url: '/favorite/status',
                data: { shopId: shopId },
                async: false, // 同期的に設定
                success: function(response) {
                    isFavorited = response.isFavorited;
                },
                error: function(xhr, status, error) {
                    console.error(xhr.responseText);
                }
            });

            return isFavorited;
        }

        $('.favorite-btn').click(function() {
            var shopId = $(this).data('shop-id');
            var isFavorited = $(this).data('is-favorited');
            var button = $(this);

            // お気に入りをトグルするAPIリクエストを送信
            $.ajax({
                type: 'POST',
                url: '/favorite/toggle',
                data: { shopId: shopId },
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                success: function(response) {
                    // ハートマークの色を切り替える
                    if (response.isFavorited) {
                        button.find('i').addClass('heart-filled');
                    } else {
                        button.find('i').removeClass('heart-filled');
                    }

                    // データ属性を更新
                    button.data('is-favorited', response.isFavorited);

                    // コンソールにログを出力
                    // console.log('APIリクエスト成功:', response);
                },
                error: function(xhr, status, error) {
                    console.error(xhr.responseText);
                    // コンソールにログを出力
                    // console.error('APIリクエストエラー:', status, error);
                }
            });
        });
    </script>
</body>
</html>