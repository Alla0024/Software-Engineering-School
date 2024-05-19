<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Mail;
use App\Models\Subscription;

class SendDailyRate extends Command
{
    protected $signature = 'send:daily-rate';
    protected $description = 'Send daily USD to UAH rate to all subscribers';

    public function __construct()
    {
        parent::__construct();
    }

    public function handle()
    {
        $response = Http::get('https://api.exchangerate-api.com/v4/latest/USD');
        if ($response->successful()) {
            $rate = $response->json()['rates']['UAH'];
            $subscribers = Subscription::all();
            foreach ($subscribers as $subscriber) {
                Mail::raw("Current USD to UAH rate: $rate", function ($message) use ($subscriber) {
                    $message->to($subscriber->email)
                        ->subject('Daily USD to UAH Rate');
                });
            }
        }
    }
}
