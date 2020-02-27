<?php

namespace App\Providers;

use App\Myself\MyListener;
use App\Events\PostSavedEvent;
use App\Listeners\PostSavedListener;
use Illuminate\Support\Facades\Event;
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
        PostSavedEvent::class => [
            PostSavedListener::class,
            MyListener::class,
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

        // //
        // Event::listen(PostSavedEvent::class,function($one){
        //     dd("fdsajiofj");
        // });
    }
}

