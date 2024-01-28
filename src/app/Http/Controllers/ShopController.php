<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Shop;
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

    public function detail()
    {
        return view('detail');
    }

    public function menu()
    {
        $prevurl = url()->previous();
        return view('menu', ['prevurl' => $prevurl]);
    }

    public function mypage()
    {
        $user = Auth::user();
        return view('mypage', ['user' => $user]);
    }

    public function getResult(Request $request)
    {
        // 選択されたオプションに基づいて結果を生成
        $result = '選択された日付: ' . $request->input('date') . ', 時間: ' . $request->input('time') . ', 人数: ' . $request->input('number');

        // 結果を返す
        return $result;
    }
}
