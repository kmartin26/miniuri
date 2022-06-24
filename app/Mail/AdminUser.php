<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class AdminUser extends Mailable
{
    use Queueable, SerializesModels;

    protected $admin;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($admin)
    {
        $this->admin = $admin;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->view('emails.admin-user')
                ->subject('Administration account')
                ->with([
                    'adminUsername' => $this->admin['username'],
                    'adminPassword' => $this->admin['password'],
                    'adminEmail' => $this->admin['email'],
                ]);
    }
}
