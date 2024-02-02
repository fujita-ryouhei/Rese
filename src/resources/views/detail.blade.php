<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Rese</title>
    <link rel="stylesheet" href="{{ asset('css/sanitize.css') }}">
    <link rel="stylesheet" href="{{ asset('css/detail.css') }}">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" integrity="sha512-iecdLmaskl7CVkqkXNQ/ZH/XLlvWZOJyj7Yy7tcenmpD1ypASozpmT/E0iPtmFIB46ZmdtAc9eNBvH0H/ZpiBw==" crossorigin="anonymous" referrerpolicy="no-referrer" />
</head>
<body>
    <main>
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
                        <a href="/">
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

            <div class="reservation">
                <form action="/storeReservation" method="post" class="reservation-form" id="myForm">
                    @csrf
                    <div class="reservation-content">
                        <div class="reservation-ttl">
                            <h2>
                                予約
                            </h2>
                        </div>
                        <div class="reservation-inputs">
                            <input type="hidden" name="shop_id" value="{{ $shop->id }}">
                            <input type="date" name="date" id="date">
                            <select name="time" id="time">
                                <option value=""></option>
                                <option value="1:00">1:00</option>
                                <option value="2:00">2:00</option>
                                <option value="3:00">3:00</option>
                                <option value="4:00">4:00</option>
                                <option value="5:00">5:00</option>
                                <option value="6:00">6:00</option>
                                <option value="7:00">7:00</option>
                                <option value="8:00">8:00</option>
                                <option value="9:00">9:00</option>
                                <option value="10:00">10:00</option>
                                <option value="11:00">11:00</option>
                                <option value="12:00">12:00</option>
                                <option value="13:00">13:00</option>
                                <option value="14:00">14:00</option>
                                <option value="15:00">15:00</option>
                                <option value="16:00">16:00</option>
                                <option value="17:00">17:00</option>
                                <option value="18:00">18:00</option>
                                <option value="19:00">19:00</option>
                                <option value="20:00">20:00</option>
                                <option value="21:00">21:00</option>
                                <option value="22:00">22:00</option>
                                <option value="23:00">23:00</option>
                                <option value="24:00">24:00</option>
                            </select>
                            <select name="number" id="number">
                                <option value=""></option>
                                <option value="1">1人</option>
                                <option value="2">2人</option>
                                <option value="3">3人</option>
                                <option value="4">4人</option>
                            </select>
                        </div>
                        <div class="reservation-detail">
                            <div class="reservation_list flex">
                                <p>Shop</p>
                                <p>{{ $shop->name }}</p>
                            </div>
                            <div class="reservation_list flex">
                                <p>Date</p>
                                <p id="selectedDate"></p>
                            </div>
                            <div class="reservation_list flex">
                                <p>Time</p>
                                <p id="selectedTime"></p>
                            </div>
                            <div class="reservation_list flex">
                                <p>Number</p>
                                <p  id="selectedNumber"></p>
                            </div>
                        </div>
                        <button type="submit" class="reservation-btn">予約する</button>
                    </div>
                </form>
            </div>
        </div>
    </main>
</body>

<script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
<script src="{{ asset('js/custom.js') }}"></script>

</html>