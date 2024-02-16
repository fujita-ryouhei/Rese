<?php

namespace App\Console;

use Illuminate\Console\Scheduling\Schedule;
use Illuminate\Foundation\Console\Kernel as ConsoleKernel;
use App\Models\Reservation;

class Kernel extends ConsoleKernel
{
    /**
     * Define the application's command schedule.
     *
     * @param  \Illuminate\Console\Scheduling\Schedule  $schedule
     * @return void
     */
    protected function schedule(Schedule $schedule)
    {
        $schedule->call(function () {
            // リマインダーを送る処理をここに記述する
            // 予約当日のリマインダーを取得する
            $reminders = Reservation::whereDate('date', now()->toDateString())->get();

            // 取得したリマインダーに対して通知を送る
            foreach ($reminders as $reminder) {
                // reminder:send コマンドを呼び出し
                Artisan::call('reminder:send');
            }
        })->dailyAt('06:00'); // 予約当日の朝 6 時に実行する
    }

    /**
     * Register the commands for the application.
     *
     * @return void
     */
    protected function commands()
    {
        $this->load(__DIR__.'/Commands');

        require base_path('routes/console.php');
    }
}
