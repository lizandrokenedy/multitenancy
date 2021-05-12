<?php

namespace App\Mail;

use App\Models\User;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class RegisterNewUser extends Mailable
{
    use Queueable, SerializesModels;


    private $user;

    /**
     * Create a new message instance.
     *
     * @return void
     */
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
        $this->subject('Bem vindo novo usuário!');
        $this->to($this->user->email, $this->user->name);
        $this->from(env('MAIL_FROM_ADDRESS'), env('MAIL_FROM_NAME'));

        return $this->markdown('mail.register-user', ['user' => $this->user]);
    }
}
