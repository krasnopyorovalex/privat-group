<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

/**
 * Class CallbackPopupSent
 * @package App\Mail
 */
class CallbackPopupSent extends Mailable
{
    use Queueable, SerializesModels;

    private $data;

    /**
     * CallbackPopupSent constructor.
     * @param $data
     */
    public function __construct($data)
    {
        $this->data = $data;
    }

    /**
     * @return CallbackPopupSent
     */
    public function build(): CallbackPopupSent
    {
        return $this->from(env('MAIL_FROM_ADDRESS'))
            ->subject('Форма: Заказ звонка')
            ->view('emails.callback-popup', [
                'data' => $this->data
            ]);
    }
}
