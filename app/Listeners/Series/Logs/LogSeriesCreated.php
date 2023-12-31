<?php

namespace App\Listeners\Series\Logs;

use App\Events\Series\SeriesCreated as SeriesCreatedEvent;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Support\Facades\Log;

class LogSeriesCreated implements ShouldQueue
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
    public function handle(SeriesCreatedevent $event): void
    {
        Log::info("A série '{$event->seriesName}' com o id '{$event->seriesId}' foi criada com sucesso.");
    }
}
