<?php

namespace App\Listeners;

use App\Events\PostSavedEvent;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use App\Admin\Post;

class PostSavedListener //implements ShouldQueue
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
        $event->post->content = "new Content";
    }
}
