<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class Contact extends Mailable
{
    use Queueable, SerializesModels;

    protected $args;

    public function __construct($args)
    {
        $this->args = $args;
    }

    public function build()
    {
        return $this->text('contact.contact_template')
            ->subject('Webサイトからの問い合わせがありました。')
            ->with($this->args);
    }
}
