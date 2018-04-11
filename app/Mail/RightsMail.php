<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;
use App\Model\Rights;

class RightsMail extends Mailable
{
    use Queueable, SerializesModels;

    protected $rights;

    /**
     * Create a new message instance.
     *
     * @param Rights $rights
     */
    public function __construct(Rights $rights)
    {
        $this->rights = $rights;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->markdown('emails.rights',['rights'=>$this->rights]);
    }
}
