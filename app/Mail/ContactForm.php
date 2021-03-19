<?php

namespace App\Mail;

use App\Models\Contact;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class ContactForm extends Mailable
{
    use Queueable, SerializesModels;

    protected $contact;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct(Contact $contact)
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
        return $this->view('emails.contact')
                ->subject('Contact: ' . trim($this->contact->subject))
                ->replyTo($this->contact->email)
                ->with([
                    'contactName' => $this->contact->name,
                    'contactEmail' => $this->contact->email,
                    'contactSubject' => $this->contact->subject,
                    'contactMessage' => $this->contact->message,
                ]);
    }
}
