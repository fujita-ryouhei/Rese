<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\ReservationRequest;
use App\Models\Shop;
use App\Models\Reservation;
use App\Models\Favorite;
use Auth;

class ShopController extends Controller
{
    public function index()
    {
        $shops = Shop::all();
        return view('index', ['shops' => $shops]);
    }

    public function getStatus(Request $request)
    {
        // ログインユーザーのID（仮定）
        $userId = auth()->id();

        // リクエストからショップIDを取得
        $shopId = $request->input('shopId');

        // お気に入りの状態をデータベースから取得
        $isFavorited = Favorite::where('user_id', $userId)
            ->where('shop_id', $shopId)
            ->exists();

        // 取得したお気に入りの状態をJSON形式で返す
        return response()->json(['isFavorited' => $isFavorited]);
    }

    /**
     * お気に入りをトグルするアクション
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function toggle(Request $request)
    {
        $shopId = $request->input('shopId');
        $user = Auth::user();

        // お気に入りをトグルする
        $user->favorites()->toggle($shopId);

        // 成功時のレスポンスなどを返す
        return response()->json(['isFavorited' => $user->favorites()->where('shop_id', $shopId)->exists()]);
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
        // eager loadingでN+1 クエリ問題を回避
        $userReservations->load('shop');

        // ログインユーザーのIDを取得
        $userId = Auth::id();
        $shops = Shop::all();

        // お気に入りの状態を取得
        $favoriteShops = $shops->filter(function ($shop) use ($userId) {
            $shop->isFavorited = $userId ? $this->isShopFavorited($userId, $shop->id) : false;
            return $shop->isFavorited;
        });

        return view('mypage', ['user' => $user, 'reservations' => $userReservations, 'shops' => $shops]);
    }

    private function isShopFavorited($userId, $shopId)
    {
        // ログインユーザーのIDが存在する場合のみ検索
        if ($userId) {
            return Favorite::where('user_id', $userId)
                ->where('shop_id', $shopId)
                ->exists();
        }

        return false;
    }

    public function getResult(Request $request)
    {
        // 選択されたオプションに基づいて結果を生成
        $result = '選択された日付: ' . $request->input('date') . ', 時間: ' . $request->input('time') . ', 人数: ' . $request->input('number');

        // 結果を返す
        return $result;
    }
}
