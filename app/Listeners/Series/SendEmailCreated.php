<?php

namespace App\Listeners\Series;

use App\Events\Series\SeriesCreated as SeriesCreatedEvent;
use App\Mail\SeriesCreated;
use App\Repositories\Eloquent\EloquentUsersRepository;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Support\Facades\Mail;

class SendEmailCreated implements ShouldQueue
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
    public function handle(SeriesCreatedEvent $event): void
    {
        $usersRepository = new EloquentUsersRepository();
        $users = $usersRepository->findAll();
        foreach ($users as $index => $user) {
            $email = new SeriesCreated(
                $event->seriesName,
                $event->seriesId,
                $event->seasonsQty,
                $event->episodesPerSeason,
                $user->name
            );

            $when = now()->addSeconds($index * 4);
            Mail::to($user)->later($when, $email);
        }
    }
}
