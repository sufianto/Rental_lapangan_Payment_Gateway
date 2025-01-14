<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Midtrans\Config;

class MidtransServiceProvider extends ServiceProvider
{
    public function boot()
    {
        $this->setMidtransConfig();
    }

    private function setMidtransConfig()
    {
        Config::$serverKey = config('SB-Mid-server-u5pja2z7GZrnhdhUxaBPd4lJ');
        Config::$clientKey = config('SB-Mid-client-9XmwY5c_p8hgVn3C');
        Config::$isProduction = config('midtrans.is_production');
        Config::$isSanitized = true;
        Config::$is3ds = true;
    }

    public function register()
    {
        //
    }
}
