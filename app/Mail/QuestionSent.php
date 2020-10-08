<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

/**
 * Class QuestionSent
 * @package App\Mail
 */
class QuestionSent extends Mailable
{
    use Queueable, SerializesModels;

    private $data;

    /**
     * OrderServiceSent constructor.
     * @param $data
     */
    public function __construct($data)
    {
        $this->data = $data;
    }

    /**
     * @return QuestionSent
     */
    public function build(): QuestionSent
    {
        return $this->from(env('MAIL_FROM_ADDRESS'))
            ->subject('Форма: Задать вопрос директору')
            ->view('emails.question', [
                'data' => $this->data
            ]);
    }
}
