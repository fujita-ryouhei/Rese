<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Rese</title>
    <link rel="stylesheet" href="{{ asset('css/sanitize.css') }}">
    <link rel="stylesheet" href="{{ asset('css/login.css') }}">
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
            <div class="alert alert-success" style="padding: 10px; background-color: rgb(176, 255, 200);">
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
                    <p>Login</p>
                </div>
                <div class="contents">
                    <form action="/signIn" method="get" class="register-form">
                        @csrf
                        <div class="contents-item">
                            <div class="contents-item_img">
                                <i class="fa-solid fa-envelope fa-fw fa-lg"></i>
                            </div>
                            <input type="email" name="email" id="email" class="contents-item_explanation" placeholder="Email" value="{{ old('email') }}">
                        </div>
                        <div class="contents-item">
                            <div class="contents-item_img">
                                <i class="fa-solid fa-lock fa-fw fa-lg"></i>
                            </div>
                            <input type="password" name="password" id="password" class="contents-item_explanation" placeholder="Password">
                        </div>
                        <div class="form-button">
                            <button type="submit" class="button">ログイン</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </main>
</body>
</html>