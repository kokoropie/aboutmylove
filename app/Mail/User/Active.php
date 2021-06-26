<?php

namespace App\Mail\User;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class Active extends Mailable
{
    use Queueable, SerializesModels;

    public $user;
    public $url_activation;
    public $short_title;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($user, $url_activation, $short_title)
    {
        $this->user = $user;
        $this->url_activation = $url_activation;
        $this->short_title = $short_title;

    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->subject('Kích hoạt tài khoản')->view('emails.user.active');
    }
}
