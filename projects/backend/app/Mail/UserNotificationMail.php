<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\View;

class UserNotificationMail extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * @var
     */
    protected $commentUser;

    /**
     * @var
     */
    protected $post;

    /**
     * Create a new message instance.
     * @param $commentUser
     * @param $post
     * @return void
     */
    public function __construct($commentUser, $post)
    {
        $this->commentUser = $commentUser;
        $this->post = $post;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        View::share('commentUser', $this->commentUser);
        View::share('post', $this->post);
        return $this->from('server@gmail.com')->view('notifications.added-comment');
    }
}
