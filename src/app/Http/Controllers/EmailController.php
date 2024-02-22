<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\SendEmailRequest;
use Illuminate\Support\Facades\Mail;
use App\Models\User;
use App\Mail\SendEmail;

class EmailController extends Controller
{
    public function sendEmail(SendEmailRequest $request)
    {
        $user = auth()->user();

        if ($user->isAdmin()) {
            // 管理者の場合、すべてのユーザーにメール送信
            $recipients = User::whereNotIn('id', User::getAdminIds())->get();
        } elseif ($user->isStoreRepresentative()) {
            // 店舗代表者の場合、一般ユーザーにメール送信
            $recipients = User::where('role_id', 1)->get();
        } else {
            // その他の場合はアクセスを拒否
            abort(403, 'Unauthorized');
        }

        $subject = $request->input('subject');
        $content = $request->input('content');

        // ここでメール送信の処理を実装
        foreach ($recipients as $recipient) {
            Mail::to($recipient->email)->send(new SendEmail($subject, $content));
        }

        return back()->with('success', 'メールが送信されました');
    }
}
