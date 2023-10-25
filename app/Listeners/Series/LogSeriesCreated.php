<?php

namespace App\Listeners\Series;

use App\Events\Series\SeriesCreated;
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
    public function handle(SeriesCreated $event): void
    {
        Log::info("A série '{$event->seriesName}' com o id '{$event->seriesId}' foi criada com sucesso.");
    }
}
