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
        @can('admin')
            <div class="menu-box">
                <a href="/" class="links">Home</a>
                <a href="/logout" class="links">Logout</a>
                <a href="/admin" class="links">Admin</a>
                <a href="/send/email" class="links">Mail Form</a>
            </div>
        @endcan

        @can('representative')
            <div class="menu-box">
                <a href="/" class="links">Home</a>
                <a href="/logout" class="links">Logout</a>
                <a href="/shop/create" class="links">Create Shop</a>
                <a href="/shop/{id}" class="links">Shop Information</a>
                <a href="/reservation/info" class="links">Reservation Information</a>
                <a href="/send/email" class="links">Mail Form</a>
            </div>
        @endcan

        @auth
        @if(auth()->user()->role_id !== 5 && auth()->user()->role_id !== 10)
            <div class="menu-box">
                <a href="/" class="links">Home</a>
                <a href="/logout" class="links">Logout</a>
                <a href="/mypage" class="links">Mypage</a>
            </div>
        @endif
        @endauth

        @guest
        <div class="menu-box">
            <a href="/" class="links">Home</a>
            <a href="/register" class="links">Registration</a>
            <a href="/login" class="links">Login</a>
        </div>
        @endguest
    </main>
</body>
</html>