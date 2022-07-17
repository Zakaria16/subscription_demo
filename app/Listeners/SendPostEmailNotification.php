<?php

namespace App\Listeners;

use App\Event\PostPublishEvent;
use App\Notifications\PostPublished;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Support\Facades\Notification;

class SendPostEmailNotification implements ShouldQueue
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
     * @param  \App\Event\PostPublishEvent  $event
     * @return void
     */
    public function handle(PostPublishEvent $event)
    {
        Notification::send($event->users, new PostPublished($event->post));
    }


}
