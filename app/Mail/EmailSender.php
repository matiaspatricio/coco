<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class EmailSender extends Mailable
{
    use Queueable, SerializesModels;

    public $email_sender;

    private $view_html =null;
    private $view_text =null;
    private $asunto = null;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($email_sender,$asunto,$view_html,$view_text = null)
    {
        $this->email_sender = $email_sender;
        $this->view_html = $view_html;
        $this->view_text = $view_text;
        $this->asunto = $asunto;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        $respuesta = $this->from(env('MAIL_FROM_ADDRESS', 'matiasp@matiasp.stabcode.com'))
        ->subject($this->asunto." - ".Config("app.name"))
        ->view($this->view_html);

        if($this->view_text != null)
        {
            $respuesta->text($this->view_text);
        }

        return $respuesta;
    }
}
