<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Rese</title>
    <link rel="stylesheet" href="{{ asset('css/sanitize.css') }}">
    <link rel="stylesheet" href="{{ asset('css/menu.css') }}">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" integrity="sha512-iecdLmaskl7CVkqkXNQ/ZH/XLlvWZOJyj7Yy7tcenmpD1ypASozpmT/E0iPtmFIB46ZmdtAc9eNBvH0H/ZpiBw==" crossorigin="anonymous" referrerpolicy="no-referrer" />
</head>
<body>
    <header class="header">
        <div class="header-icon">
            <a href="{{ url()->previous() }}">
                <h1 class="header-icon_x"><i class="fa-solid fa-x"></i></h1>
            </a>
        </div>
    </header>

    <main>
        @auth
        <div class="menu-box">
            <a href="/" class="links">Home</a>
            <a href="/logout" class="links">Logout</a>
            <a href="/mypage" class="links">Mypage</a>
        </div>
        @endauth

        @guest
        <div class="menu-box">
            <a href="/" class="links">Home</a>
            <a href="/login" class="links">Login</a>
            <a href="/mypage" class="links">Mypage</a>
        </div>
        @endguest
    </main>
</body>
</html>