<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\URL;

class Notification extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * Create a new message instance.
     *
     * @return void
     */
	public $user;
    public function __construct($user)
    {
        //
		$this->user = $user;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        
        return $this->markdown('page.front.mail.notification')
					->with([
                        'greeting' => 'Hello Admin',
						'introLines' => 'Congraluations ! A new user '.$this->user->name.' registered with your software.',
						'actionText' => 'View',
						'displayableActionUrl' => URL::to('/admin/login'),
						'actionUrl' => URL::to('/admin/login'),
                    ]);
    }
}
