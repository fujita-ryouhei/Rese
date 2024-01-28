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
                <option value="area1">Area 1</option>
                <option value="area2">Area 2</option>
            </select>
            <select name="genre" id="genreSelect">
                <option value="">All genre</option>
                <option value="genre1">Genre 1</option>
                <option value="genre2">Genre 2</option>
            </select>
            <input type="text" class="search-input" id="searchInput" placeholder="🔍Search...">
        </div>
    </header>

    <main>
        <div class="flex__item wrap">
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
</body>

    <script>
        function startSearch() {
            // 選択されたエリアとジャンルの値を取得
            var selectedArea = document.getElementById('areaSelect').value;
            var selectedGenre = document.getElementById('genreSelect').value;

            // 検索キーワードを取得
            var searchTerm = document.getElementById('searchInput').value;

            // ここで検索の実際の処理を行う（例: 選択されたエリア・ジャンルと検索キーワードを利用して結果を表示する）
            alert('検索: エリア - ' + selectedArea + ', ジャンル - ' + selectedGenre + ', キーワード - ' + searchTerm);
        }

        // Enterキーが押されたときに検索を開始するイベントリスナーを追加
        document.getElementById('searchInput').addEventListener('keypress', function(event) {
            if (event.key === 'Enter') {
            startSearch();
            }
        });
    </script>
</html>