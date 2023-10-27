<?php

namespace App\Listeners\Series;

use App\Events\Series\EmailSent as EmailSentEvent;
use App\Events\Series\SeriesCreated as SeriesCreatedEvent;
use App\Mail\SeriesCreated;
use App\Repositories\Eloquent\EloquentUsersRepository;
use Exception as Exception;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Support\Facades\Log;
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
                username: $user->name
            );

            $when = now()->addSeconds($index * 4);
            Mail::to($user)->later($when, $email);

            EmailSentEvent::dispatch(
                $user->email,
                $event->seriesName
            );
        }

        # TODO: Mesmo quando o email não é enviado, ele adiciona o log de enviado
    }
}
