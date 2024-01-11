<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Rese</title>
    <link rel="stylesheet" href="{{ asset('css/sanitize.css') }}">
    <link rel="stylesheet" href="{{ asset('css/index.css') }}">
</head>
<body>
    <header class="header">
        <div class="header-icon">
            <a href="/">
                <h1 class="header-icon_ttl">Rese</h1>
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

            <div class="card">
                <div class="card__img">
                    <img src="https://coachtech-matter.s3-ap-northeast-1.amazonaws.com/image/izakaya.jpg" alt="" />
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
                    <img src="https://coachtech-matter.s3-ap-northeast-1.amazonaws.com/image/italian.jpg" alt="" />
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
                    <img src="https://coachtech-matter.s3-ap-northeast-1.amazonaws.com/image/ramen.jpg" alt="" />
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