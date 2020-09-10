<?php

namespace JoggApp\MailViewer\Tests\Stubs\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class TestEmailWithNoConstructor extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->view('mailviewer::stubs.emailtestview');
    }
}
