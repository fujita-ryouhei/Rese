<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Rese</title>
    <link rel="stylesheet" href="{{ asset('css/sanitize.css') }}">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" integrity="sha512-iecdLmaskl7CVkqkXNQ/ZH/XLlvWZOJyj7Yy7tcenmpD1ypASozpmT/E0iPtmFIB46ZmdtAc9eNBvH0H/ZpiBw==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="{{ asset('css/index.css') }}">
    <!-- jQueryの読み込み -->
    <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
</head>
<body>
    <header class="header">
        <div class="header-icon">
            <a href="/menu">
                <h1 class="header-icon_ttl"><i class="fa-solid fa-square-poll-horizontal fa-fw"></i>Rese</h1>
            </a>
        </div>
        <div class="search-container">
            <select name="areas" id="areaSelect">
                <option value="">All area</option>
                <option value="東京都">東京都</option>
                <option value="大阪府">大阪府</option>
                <option value="福岡県">福岡県</option>
            </select>
            <select name="genre" id="genreSelect">
                <option value="">All genre</option>
                <option value="寿司">寿司</option>
                <option value="焼肉">焼肉</option>
                <option value="居酒屋">居酒屋</option>
                <option value="イタリアン">イタリアン</option>
                <option value="ラーメン">ラーメン</option>
            </select>
            <input type="text" class="search-input" id="searchInput" placeholder="🔍Search...">
        </div>
    </header>

    <main>
        <div class="flex__item wrap" id="searchResults">
            @foreach($shops->take(20) as $shop)
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
            @endforeach
        </div>
    </main>

    <script>
        var originalShops = {!! json_encode($shops->take(20)) !!};

        function startSearch() {
            var selectedArea = document.getElementById('areaSelect').value;
            var selectedGenre = document.getElementById('genreSelect').value;
            var searchTerm = document.getElementById('searchInput').value;

            var searchResults = originalShops.filter(function (shop) {
                return shop.location.includes(selectedArea) &&
                    shop.category.includes(selectedGenre) &&
                    shop.name.toLowerCase().includes(searchTerm.toLowerCase());
            });

            updateSearchResults(searchResults);
            bindFavoriteButtonClickEvent();
        }

        function getFavoriteStatusSync(shopId) {
            var isFavorited = false;

            $.ajax({
                type: 'GET',
                url: '/favorite/status',
                data: { shopId: shopId },
                async: false,
                success: function(response) {
                    isFavorited = response.isFavorited;
                },
                error: function(xhr, status, error) {
                    console.error(xhr.responseText);
                }
            });

            return isFavorited;
        }

        function updateSearchResults(results) {
            var resultContainer = document.getElementById('searchResults');
            resultContainer.innerHTML = '';

            results.forEach(function (shop, index) {
                var card = document.createElement('div');
                card.className = 'card';
                var isFavorited = getFavoriteStatusSync(shop.id);

                card.innerHTML = `
                    <div class="card__img">
                        <img src="${shop.image_url}" alt="" />
                    </div>
                    <div class="card__content">
                        <div class="card__content-cat">${shop.name}</div>
                        <div class="card__content-tag">
                            <p class="card__content-tag-item">#${shop.location}</p>
                            <p class="card__content-tag-item">#${shop.category}</p>
                        </div>
                        <a href="/detail/${shop.id}">
                            <div class="card__content-detail">詳しくみる</div>
                        </a>
                        <button class="favorite-btn" data-shop-id="${shop.id}" data-original-index="${index}">
                            @csrf
                            <i class="fa-solid fa-heart fa-2x ${isFavorited ? 'heart-filled' : ''}" style="color: ${isFavorited ? '#f04242' : '#c7c7c7'};"></i>
                        </button>
                    </div>`;

                resultContainer.appendChild(card);
            });

            bindFavoriteButtonClickEvent();
        }

        function getFavoriteStatus(shopId, callback) {
            $.ajax({
                type: 'GET',
                url: '/favorite/status',
                data: { shopId: shopId },
                success: function(response) {
                    callback(response.isFavorited);
                },
                error: function(xhr, status, error) {
                    console.error(xhr.responseText);
                    callback(false);
                }
            });
        }

        function bindFavoriteButtonClickEvent() {
            $('.favorite-btn').off('click');

            $('.favorite-btn').click(function() {
                var shopId = $(this).data('shop-id');
                var button = $(this);

                $.ajax({
                    type: 'POST',
                    url: '/favorite/toggle',
                    data: { shopId: shopId },
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    success: function(response) {
                        if (response.isFavorited) {
                            button.find('i').addClass('heart-filled');
                        } else {
                            button.find('i').removeClass('heart-filled');
                        }
                    },
                    error: function(xhr, status, error) {
                        console.error(xhr.responseText);
                    }
                });
            });
        }

        document.getElementById('searchInput').addEventListener('keypress', function(event) {
            if (event.key === 'Enter') {
                startSearch();
            }
        });

        bindFavoriteButtonClickEvent();

        $(document).ready(function() {
            $('.favorite-btn').each(function() {
                var shopId = $(this).data('shop-id');
                var button = $(this);

                getFavoriteStatus(shopId, function(isFavorited) {
                    if (isFavorited) {
                        button.find('i').addClass('heart-filled');
                    }
                });
            });
        });

        $('.favorite-btn').click(function() {
            var shopId = $(this).data('shop-id');
            var button = $(this);

            console.log('Button clicked!');

            $.ajax({
                type: 'POST',
                url: '/favorite/toggle',
                data: { shopId: shopId },
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                success: function(response) {
                    console.log('Response:', response);

                    if (response.isFavorited) {
                        console.log('Adding class: heart-filled');
                        button.find('i').addClass('heart-filled');
                    } else {
                        console.log('Removing class: heart-filled');
                        button.find('i').removeClass('heart-filled');
                    }
                },
                error: function(xhr, status, error) {
                    console.error(xhr.responseText);
                }
            });
        });
    </script>
</body>

</html>