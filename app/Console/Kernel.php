<?php

namespace App\Console;

use Illuminate\Console\Scheduling\Schedule;
use Illuminate\Foundation\Console\Kernel as ConsoleKernel;

class Kernel extends ConsoleKernel
{
    /**
     * Daftar command bawaan untuk aplikasi Anda.
     *
     * @var array
     */
    protected $commands = [
        // Tambahkan custom command Anda di sini, jika ada
    ];

    /**
     * Tentukan jadwal command.
     */
    // protected function schedule(Schedule $schedule): void
    // {
    //     $schedule->call(function () {
    //         \App\Models\Biaya::resetDailyStock();
    //     })->daily();
    // }
    protected function schedule(Schedule $schedule)
{
    $schedule->job(new \App\Jobs\RestoreStockJob)->everyMinute();
}

    /**
     * Daftarkan perintah Artisan untuk aplikasi.
     */
    protected function commands(): void
    {
        $this->load(__DIR__ . '/Commands');

        require base_path('routes/console.php');
    }
}
