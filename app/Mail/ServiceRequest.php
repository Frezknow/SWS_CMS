<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class ServiceRequest extends Mailable
{
    use Queueable, SerializesModels;
    public $service;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($service)
    {
        $this->service = $service;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        $subject = $this->service->subject;
        $from = $this->service->email;
        $sr = $this->service->id;
        return $this->subject("Service request #$sr from website.")
                    ->from($from)
                    ->view('mails.RequestService')
                    ->with([
                      'subject' => $this->service->subject,
                      'email' => $this->service->email,
                      'name' => $this->service->name,
                      'img' =>$this->service->img,
                      'content' => $this->service->content
                    ]);
    }
}
