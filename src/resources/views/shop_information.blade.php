<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Rese</title>
    <link rel="stylesheet" href="{{ asset('css/sanitize.css') }}">
    <link rel="stylesheet" href="{{ asset('css/shop_information.css') }}">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" integrity="sha512-iecdLmaskl7CVkqkXNQ/ZH/XLlvWZOJyj7Yy7tcenmpD1ypASozpmT/E0iPtmFIB46ZmdtAc9eNBvH0H/ZpiBw==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
</head>
<body>
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

        <div class="wrap">
            <div class="detail">
                <header class="header">
                    <div class="header-icon">
                        <a href="/menu">
                            <h1 class="header-icon_ttl"><i class="fa-solid fa-square-poll-horizontal fa-fw"></i>Rese</h1>
                        </a>
                    </div>
                </header>

                <div class="explanation">
                    <div class="explanation-name">
                        <a href="{{ url()->previous() }}">
                            <h3 class="explanation_arrow">
                                <
                            </h3>
                        </a>
                        <h3 class="explanation-ttl">
                            {{ $shop->name }}
                        </h3>
                    </div>
                    <div class="explanation-img">
                        <img src="{{ $shop->image_url }}" alt="" />
                    </div>
                    <div class="explanation-tag">
                        <p class="explanation-tag-item">#{{ $shop->location }}</p>
                        <p class="explanation-tag-item">#{{ $shop->category }}</p>
                    </div>
                    <div class="explanation-content">
                        <p>
                            {{ $shop->explanation }}
                        </p>
                    </div>
                </div>
            </div>

            <div class="update">
                <form action="{{ route('shop.update', $shop->id) }}" method="post" class="update-form" id="myForm">
                    @csrf
                    @method('PUT')
                    <div class="update-content">
                        <div class="update-ttl">
                            <h2>
                                店舗情報を編集
                            </h2>
                        </div>
                        <div class="update-inputs">
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
                        </div>
                        <button type="submit" class="update-btn">編集する</button>
                    </div>
                </form>
            </div>
        </div>
    </main>
</body>
</html>