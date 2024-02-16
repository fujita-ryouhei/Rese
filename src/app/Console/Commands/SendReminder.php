<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\Reservation;
use Illuminate\Support\Facades\Mail;
use App\Mail\ReservationReminderMail;

class SendReminder extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'reminder:send';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Send reminder';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        $this->sendReminder();
    }

    public function sendReminder()
    {
        // 予約当日の予約情報を取得
        $reservations = Reservation::whereDate('date', now())->with('user', 'shop')->get();

        foreach ($reservations as $reservation) {
            // 予約者名
            $userName = $reservation->user->name;
            // 予約店舗名
            $shopName = $reservation->shop->name;
            // 予約者にリマインダーメールを送信
            Mail::to($reservation->user->email)->send(new ReservationReminderMail($reservation, $userName, $shopName));
        }
        $this->info('Reminder sent successfully!');
    }
}
