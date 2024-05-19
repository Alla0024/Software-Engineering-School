<?php

namespace App\Console;

use App\Http\Controllers\API\AdWordsController;
use App\Http\Controllers\API\GoogleMerchantController;
use App\Http\Controllers\API\HotlineController;
use App\Http\Controllers\API\IbudController;
use App\Http\Controllers\API\MungerController;
use App\Http\Controllers\API\NadaviController;
use App\Http\Controllers\API\PriceUaController;
use App\Http\Controllers\API\PromController;
use App\Http\Controllers\API\RozetkaController;
use App\Http\Controllers\API\VseCeniController;
use Illuminate\Console\Scheduling\Schedule;
use Illuminate\Foundation\Console\Kernel as ConsoleKernel;
use Illuminate\Support\Facades\Cache;
use Log;

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
        $schedule->command('send:daily-rate')->daily();
    }
}
