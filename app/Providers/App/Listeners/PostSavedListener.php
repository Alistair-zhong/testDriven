<?php

namespace App\Providers\App\Listeners;

use App\Providers\App\Events\PostSavedEvent;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;

class PostSavedListener
{
    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     *
     * @param  PostSavedEvent  $event
     * @return void
     */
    public function handle(PostSavedEvent $event)
    {
        //
    }
}
