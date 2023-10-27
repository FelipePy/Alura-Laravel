<?php

namespace App\Listeners\Series\Logs;

use App\Events\Series\EmailSent as EmailSentEvent;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Support\Facades\Log;

class LogEmailSent implements ShouldQueue
{
    /**
     * Create the event listener.
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     */
    public function handle(EmailSentEvent $event): void
    {
        Log::info("Email enviado para {$event->email} notificando a criação de série '{$event->seriesName}'.");
    }

    # TODO: Preciso criar mais logs
}
