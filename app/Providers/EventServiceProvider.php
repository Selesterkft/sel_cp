<?php

namespace App\Providers;

use App\Listeners\UserChangeListener;
//use Illuminate\Support\Facades\Event;
use Illuminate\Auth\Events\Registered;
use Illuminate\Auth\Listeners\SendEmailVerificationNotification;
use Illuminate\Foundation\Support\Providers\EventServiceProvider as ServiceProvider;

class EventServiceProvider extends ServiceProvider
{
    /**
     * The event listener mappings for the application.
     *
     * @var array
     */
    protected $listen = [
        Registered::class => [
            SendEmailVerificationNotification::class,
        ],
        // TODO: Így mindíg meghívódik. Megoldani, hogy csak a bejelentkezéskor fusson le.
        // TODO: https://laravel.com/docs/5.4/authentication#events,
        // TODO: https://stackoverflow.com/questions/42360183/how-to-set-session-variable-when-user-login-in-laravel
        'Illuminate\Auth\Events\Authenticated' => [
            UserChangeListener::class,
        ],
    ];

    /**
     * Register any events for your application.
     *
     * @return void
     */
    public function boot()
    {
        parent::boot();

        //
    }
}
