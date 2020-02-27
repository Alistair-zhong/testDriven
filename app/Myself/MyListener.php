<?php

namespace App\Myself;

use App\Events\PostSavedEvent;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;

class MyListener
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
        $event->post->content = "hello this is custom content";
    }
}
