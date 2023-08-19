<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class PasswordResetEmail extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->view('mails.sendFull')
            ->subject($this->subject)
            ->from('guess@gmail.com', 'Guess')
            ->with([
                'name'        => $this->name,
                'subject'     => $this->subject,
                'email'       => $this->email,
                'description' => $this->description,
            ]);
    }
}
