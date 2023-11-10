<?php

namespace App\Providers;

use App\Events\Series\DeletedSeries;
use App\Events\Series\EmailSent;
use App\Events\Series\SeriesCreated;
use App\Listeners\Series\DeleteCover;
use App\Listeners\Series\Logs\LogEmailSent;
use App\Listeners\Series\Logs\LogSeriesCreated;
use App\Listeners\Series\SendEmailCreated;
use Illuminate\Auth\Events\Registered;
use Illuminate\Auth\Listeners\SendEmailVerificationNotification;
use Illuminate\Foundation\Support\Providers\EventServiceProvider as ServiceProvider;

class EventServiceProvider extends ServiceProvider
{
    /**
     * The event to listener mappings for the application.
     *
     * @var array<class-string, array<int, class-string>>
     */
    protected $listen = [
        Registered::class => [
            SendEmailVerificationNotification::class,
        ],
        SeriesCreated::class => [
            SendEmailCreated::class,
            LogSeriesCreated::class
        ],
        EmailSent::class => [
            LogEmailSent::class
        ],
        DeletedSeries::class => [
            DeleteCover::class
        ]
    ];

    /**
     * Register any events for your application.
     */
    public function boot(): void
    {
        //
    }

    /**
     * Determine if events and listeners should be automatically discovered.
     */
    public function shouldDiscoverEvents(): bool
    {
        return false;
    }
}
