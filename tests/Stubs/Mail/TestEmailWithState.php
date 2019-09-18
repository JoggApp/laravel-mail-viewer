<?php

namespace JoaonzangoII\MailViewer\Tests\Stubs\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use JoaonzangoII\MailViewer\Tests\Stubs\Models\Test;

class TestEmailWithState extends Mailable
{
    use Queueable, SerializesModels;

    public $object;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct(Test $object)
    {
        $this->object = $object;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->view('mailviewer::stubs.emailtestview_withstate');
    }
}
