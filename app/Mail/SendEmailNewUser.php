<?php

namespace App\Mail;

use App\Models\User;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class SendEmailNewUser extends Mailable implements ShouldQueue
{
    use Queueable, SerializesModels;


    /**
     * @var User
     */
    private $user;

    public function __construct(User $user)
    {
        $this->user = $user;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->view('emails.users.credentials-new-user')
            ->from(config('mail.from.address'), config('mail.from.name'))
            ->subject("Bienvenido ".$this->user->name)
            ->with([
                'user' => $this->user,
            ]);
    }
}
