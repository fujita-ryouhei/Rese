<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Http\Requests\RegisterRequest;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Mail;
use App\Mail\ConfirmEmail;

class RegisteredUserController extends Controller
{
    public function register()
    {
        return view('register');
    }

    public function store(RegisterRequest $request)
    {
        $user = User::create([
            'name' => $request->input('name'),
            'email' => $request->input('email'),
            'password' => Hash::make($request->input('password')),
            'confirmation_token' => Str::random(60), // 確認トークンを生成して保存
        ]);

        // 生成したトークンを使ってメールを送信
        Mail::to($user->email)->send(new ConfirmEmail($user));

        return redirect('/thanks')->with('success', 'アカウントが作成されました。メールを確認してください。');
    }

    public function confirmEmail($token)
    {
        $user = User::where('confirmation_token', $token)->firstOrFail();

        $user->confirmed = true;
        $user->confirmation_token = null;
        $user->save();

        return redirect()->route('login')->with('success', 'メールが確認されました。ログインしてください。');
    }
}
