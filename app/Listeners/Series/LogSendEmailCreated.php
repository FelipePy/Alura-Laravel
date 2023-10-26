<?php

namespace App\Listeners\Series;

use App\Events\Series\SeriesCreated;
use App\Repositories\Eloquent\EloquentUsersRepository;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Support\Facades\Log;

class LogSendEmailCreated implements ShouldQueue
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
        $usersRepository = new EloquentUsersRepository();
        $users = $usersRepository->findAll();

        foreach ($users as $user) {
            Log::info("Email enviado para {$user->email} notificando criação de série '{$event->seriesName}'.");
        }
    }
}
