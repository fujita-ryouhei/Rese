<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\ReservationRequest;
use App\Models\Shop;
use App\Models\Reservation;
use Auth;

class ShopController extends Controller
{
    public function index()
    {
        $shops = Shop::all();
        return view('index', ['shops' => $shops]);
    }

    public function login()
    {
        return view('login');
    }

    public function thanks()
    {
        return view('thanks');
    }

    public function done()
    {
        return view('done');
    }

    public function detail($id)
    {
        $shop = Shop::find($id);
        return view('detail', compact('shop'));
    }

    public function menu()
    {
        $prevurl = url()->previous();
        return view('menu', ['prevurl' => $prevurl]);
    }

    public function storeReservation(ReservationRequest $request)
    {
        $user_id = auth()->id(); // ログインユーザーのIDを取得

        $reservation = new Reservation();
        $reservation->shop_id = $request->input('shop_id');
        $reservation->user_id = $user_id; // ログインユーザーのIDを保存
        $reservation->date = $request->input('date');
        $reservation->time = $request->input('time');
        $reservation->number_of_people = $request->input('number');
        $reservation->save();

        // 保存後に適切な処理を追加
        return redirect()->route('done');
    }


    public function mypage()
    {
        $user = Auth::user();
        $userReservations = auth()->user()->reservations;
        //  eager loadingでN+1 クエリ問題を回避
        $userReservations->load('shop');
        return view('mypage', ['user' => $user, 'reservations' => $userReservations]);
    }

    public function getResult(Request $request)
    {
        // 選択されたオプションに基づいて結果を生成
        $result = '選択された日付: ' . $request->input('date') . ', 時間: ' . $request->input('time') . ', 人数: ' . $request->input('number');

        // 結果を返す
        return $result;
    }
}
