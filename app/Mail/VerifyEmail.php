<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;
use Lunaweb\EmailVerification\Contracts\CanVerifyEmail;

class VerifyEmail extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * @var CanVerifyEmail
     */
    public $user;

    /**
     * @var string
     */
    public $token;

    /**
     * @var string
     */
    public $expiration;

    /**
     * Create a new message instance.
     *
     * @param CanVerifyEmail $user
     * @param $token
     * @param $expiration
     */
    public function __construct(CanVerifyEmail $user, $token, $expiration)
    {
        $this->user = $user;
        $this->token = $token;
        $this->expiration = $expiration;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        $email = $this->user->getEmailForEmailVerification();

        // Create activation link
        $link = route('verifyEmail', ['email' => $email, 'expiration' => $this->expiration, 'token' => $this->token]);

        //return $this->view('view.name');
    }
}
