<?php

namespace Bishopm\Churchsite\Mail;

use Illuminate\Mail\Mailable;
use Bishopm\Churchsite\Models\Setting;

class GenericMail extends Mailable
{

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public $emaildata;

    public function __construct($emaildata)
    {
        $this->emaildata=$emaildata;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        if (isset($this->emaildata['attachment'])) {
            return $this->subject($this->emaildata['subject'])
                    ->from($this->emaildata['sender'])
                    ->attachData($this->emaildata['attachment']['dataurl'], $this->emaildata['attachment']['name'], ['mime' => $this->emaildata['attachment']['type'], 'Content-Disposition' => 'attachment'])
                    ->markdown('churchsite::emails.generic');
        } else {
            return $this->subject($this->emaildata['subject'])
                    ->from($this->emaildata['sender'])
                    ->markdown('churchsite::emails.generic');
        }
    }
}
