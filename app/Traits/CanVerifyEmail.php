<?php
/**
 * Created by PhpStorm.
 * User: Ministudio2017
 * Date: 2/8/2019
 * Time: 10:26 AM
 */

namespace App\Traits;

use App\Mail\VerifyEmail;
use Illuminate\Support\Facades\Mail;
use Lunaweb\EmailVerification\Traits\CanVerifyEmail as CanVerifiyEmailBase;

trait CanVerifyEmail
{
    use CanVerifiyEmailBase;

    /**
     * @inheritDoc
     */
    public function sendEmailVerificationNotification($token, $expiration)
    {
        /*$verifyEmail = new VerifyEmail($this, $token, $expiration);

        sendMail(
            $this->getEmailForEmailVerification(),
            trans('emails.verify_email.title'),
            $verifyEmail->render()
        );*/
        // Uncomment if not using 000webhost.
        Mail::send(new VerifyEmail($this, $token, $expiration));
    }


}