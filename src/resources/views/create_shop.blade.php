<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Rese</title>
    <link rel="stylesheet" href="{{ asset('css/sanitize.css') }}">
    <link rel="stylesheet" href="{{ asset('css/create_shop.css') }}">
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
        @if(session('success'))
            <div class="alert-success" style="padding: 10px; background-color: rgb(176, 255, 200);">
                {{ session('success') }}
            </div>
        @endif

        @if ($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <div class="box">
            <div class="box-contents">
                <div class="box-header">
                    <p>店舗情報の作成</p>
                </div>
                <div class="contents">
                    <form action="/shop/store" method="post" class="create-shop-form">
                        @csrf
                        <div class="contents-item">
                            <label for="name">店舗名:</label>
                            <input type="text" name="name" id="name" class="contents-item_explanation" placeholder="ShopName" value="{{ old('name') }}">
                        </div>
                        <div class="contents-item">
                            <label for="name">イメージ画像:</label>
                            <input type="text" name="image_url" id="image_url" class="contents-item_explanation" placeholder="Image_url" value="{{ old('image_url') }}">
                        </div>
                        <div class="contents-item">
                            <label for="name">所在地(県):</label>
                            <input type="text" name="location" id="location" class="contents-item_explanation" placeholder="location" value="{{ old('location') }}">
                        </div>
                        <div class="contents-item">
                            <label for="name">カテゴリー:</label>
                            <input type="text" name="category" id="category" class="contents-item_explanation" placeholder="category" value="{{ old('category') }}">
                        </div>
                        <div class="contents-item">
                            <label for="name">店舗説明:</label>
                            <textarea name="explanation" id="explanation" cols="30" rows="10" class="contents-item_explanation textarea" placeholder="explanation" value="{{ old('explanation') }}"></textarea>
                        </div>
                        <div class="form-button">
                            <button type="submit" class="button">作成</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </main>
</body>
</html>