<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\ReservationRequest;
use App\Http\Requests\ShopRatingRequest;
use App\Models\Shop;
use App\Models\Reservation;
use App\Models\Favorite;
use App\Models\ShopRating;
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
        $ratings = ShopRating::where('shop_id', $id)->with('user')->get();

        return view('detail', ['shop' => $shop, 'ratings' => $ratings]);
    }

    public function rating(ShopRatingRequest $request)
    {
        $rating = new ShopRating();
        $rating->shop_id = $request->shop_id;
        $rating->rating = $request->rating;
        $rating->comment = $request->comment;
        $rating->user_id = Auth::id(); // ログインユーザーのIDを設定
        $rating->save();

        return redirect()->route('index');
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
            // お気に入りが存在するかどうかの条件を追加
            $hasFavorite = $userId ? $this->hasFavorite($userId, $shop->id) : false;

            // お気に入りがある場合に $shop->isFavorited を設定
            if ($hasFavorite) {
                $shop->isFavorited = true;
                return true;
            }

            return false;
        });

        return view('mypage', ['user' => $user, 'reservations' => $userReservations, 'favoriteShops' => $favoriteShops]);
    }

    private function hasFavorite($userId, $shopId)
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

    public function deleteReservation(Request $request)
    {
        // リクエストから 'reservation_id' を取得
        $reservationId = $request->input('reservation_id');

        // データベースから対象の予約を削除する処理（Eloquentモデルを使用）
        $reservation = Reservation::find($reservationId);

        if ($reservation) {
            $reservation->delete();
            // 成功時のリダイレクトなどを行う
            return redirect()->route('mypage');
        } else {
            // レコードが見つからない場合の処理
            return redirect()->route('mypage')->with('error', 'Reservation not found');
        }
    }
}
