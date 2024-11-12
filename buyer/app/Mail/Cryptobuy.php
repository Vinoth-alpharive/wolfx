<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;
use App\User;

class Cryptobuy extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public $user, $details;
    public function __construct($user,$details)
    {
        $user = User::find($user->id);
         $this->user =$user;
         $this->details = $details;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->view('email.cryptobuyreq')
        ->subject("Congrats! Your Crypto Buying Request is Successful.✅");
    }
}
