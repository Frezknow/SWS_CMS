<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class ContactUs extends Mailable
{
    use Queueable, SerializesModels;
    public $contact;
    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($contact)
    {
        $this->contact = $contact;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        $from = $this->contact->email;
        return $this->from($from)
                    ->subject("New message from contact page.")
                    ->view('mails.contactUs')
                    ->with(
                      [
                            'email' => $from,
                            'content' => $this->contact->content,
                            'name'=> $this->contact->name,
                            'call'=>$this->contact->call
                      ]);
    }

}
