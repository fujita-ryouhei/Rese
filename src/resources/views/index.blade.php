<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Rese</title>
    <link rel="stylesheet" href="{{ asset('css/sanitize.css') }}">
    <link rel="stylesheet" href="{{ asset('css/index.css') }}">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" integrity="sha512-iecdLmaskl7CVkqkXNQ/ZH/XLlvWZOJyj7Yy7tcenmpD1ypASozpmT/E0iPtmFIB46ZmdtAc9eNBvH0H/ZpiBw==" crossorigin="anonymous" referrerpolicy="no-referrer" />
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
                    </div>
                </div>
            @endforeach
        </div>
    </main>

    <script>
        // 元のショップデータをJavaScriptの変数に埋め込む
        var originalShops = {!! json_encode($shops->take(20)) !!};

        function startSearch() {
            var selectedArea = document.getElementById('areaSelect').value;
            var selectedGenre = document.getElementById('genreSelect').value;
            var searchTerm = document.getElementById('searchInput').value;

            // サーバーに対して非同期リクエストを行い、検索結果を取得します。

            var searchResults = originalShops.filter(function (shop) {
            return shop.location.includes(selectedArea) &&
                    shop.category.includes(selectedGenre) &&
                    shop.name.toLowerCase().includes(searchTerm.toLowerCase());
        });

            // DOMを更新して検索結果を表示します。
            updateSearchResults(searchResults);
        }

        function updateSearchResults(results) {
            var resultContainer = document.getElementById('searchResults');

            // 前回の結果をクリアします。
            resultContainer.innerHTML = '';

            // 各検索結果を表示します。
            results.forEach(function (shop) {
                var card = document.createElement('div');
                card.className = 'card';

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
                    </div>
                `;

                resultContainer.appendChild(card);
            });
        }

        document.getElementById('searchInput').addEventListener('keypress', function(event) {
            if (event.key === 'Enter') {
                startSearch();
            }
        });
    </script>
</body>

</html>