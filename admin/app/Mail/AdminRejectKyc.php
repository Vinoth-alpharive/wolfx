<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;
use App\Models\Coinuser;


class AdminRejectKyc extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public $user;
    public $kyc;
    public function __construct($user,$kyc)
    {
        $user = Coinuser::find($user->id);
        $this->user = $user;
        $this->kyc = $kyc;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->view('email.adminreject_kyc');
    }
}
