<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class UserBrandRequest extends Mailable
{
    use Queueable, SerializesModels;

    public $userDetail;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($userDetail)
    {
        $this->userDetail = $userDetail;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        $this->subject('User Brand Request Notification')
            ->view('emails.brand_request')
            ->attach($this->userDetail); //We can also attach pdf without storing using return $pdf->stream('document.pdf');
    }
}
