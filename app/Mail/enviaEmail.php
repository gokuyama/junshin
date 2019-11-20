<?php

namespace junshin\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class enviaEmail extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($attachment, $nome_responsavel, $mes)
    {
        //
        $this->attachment = $attachment; 
        $this->nome = $nome_responsavel;
        $this->mes = $mes;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->from('eduardo.uemura@gmail.com')
        ->view('mails.envia')
        ->attach($this->attachment)
        ->with(
          [
                'name' => $this->nome,
                'mes'  => $this->mes,      
          ]);
    }
}
