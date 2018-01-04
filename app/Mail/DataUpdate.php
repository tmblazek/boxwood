<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class DataUpdate extends Mailable
{
    use Queueable, SerializesModels;
    public $removals;
    public $additions;
    public $order_changes;
    public $title;
    public $url;
    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($removals, $additions, $order_changes, $title, $url)
    {
        //
        $this->removals =$removals;
        $this->additions =$additions;
        $this->order_changes =$order_changes;
        $this->title =$title;
        $this->url = $url;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->from("mailer@paddysreturn.com")->subject('Setlist geändert [mailer@paddysreturn.com]')->->view('mailers.data');
    }
}
