<?php

namespace App\Listeners;

use App\Events\VerifyMailEvent;
use App\Mail\VerifyMail;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;

class VerifyMailListener
{
    public function handle(VerifyMailEvent $event): void
    {
        Log::info('Handling VerifyMailEvent for email: ' . $event->email);
        Mail::to($event->email)->send(new VerifyMail($event->code));
    }
}
