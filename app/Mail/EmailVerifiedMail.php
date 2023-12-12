<?php

namespace App\Mail;

use App\Models\EmailVerified;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class EmailVerifiedMail extends Mailable
{
    use Queueable, SerializesModels;

    public $verified_mail;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct(EmailVerified  $verified_mail)
    {
        $this->verified_mail =  $verified_mail;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->view('auth.emil_verified_template')
                    ->with('data',$this->verified_mail)
                    ->subject('Email Verification');
    }
}
