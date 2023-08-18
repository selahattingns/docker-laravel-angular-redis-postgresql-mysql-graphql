<?php

namespace App\Listeners;

use App\Events\CommentCreated;
use App\Mail\UserNotificationMail;
use Illuminate\Support\Facades\Mail;

class SendCommentCreatedNotification
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
     * @param CommentCreated $event
     */
    public function handle(CommentCreated $event)
    {
        $post = optional($event->comment)->post;
        $commentUser = optional($event->comment)->user;
        $postUser = optional($post)->user;
        if ($postUser && $postUser->email){
            dispatch(function () use ($postUser, $post, $commentUser){
                Mail::to($postUser->email)->send(new UserNotificationMail($commentUser, $post));
            });
        }
    }
}
