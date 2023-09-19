<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class SendCodeResetPassword extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * Create a new message instance.
     *
     * @return void
     */

    /**
     * Build the message.
     *
     * @return $this
     */
    public $code;
    public function __construct($code)
    {
        $this->code = $code;
    }

    public function build()
    {
        // print_r()
        // return $this->markdown('send-code-reset-password')->subject("My mail title");
        $address = env("MAIL_FROM_ADDRESS");
        $name = 'My Project';
  
        $this->subject('Password Reset ')
                    ->view('send-code-reset-password')
                    ->from($address, $name);
  
        return $this;
    }
}
