<?php

namespace App\Listeners\Series;

use App\Events\Series\DeletedSeries;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Log;


class DeleteCover implements ShouldQueue
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
    public function handle(DeletedSeries $event): void
    {
        Log::alert($event->cover);
        if (Storage::disk('public')->exists($event->cover)) {
            Storage::disk('public')->delete($event->cover);
        }
    }
}
