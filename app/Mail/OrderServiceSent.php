<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

/**
 * Class OrderServiceSent
 * @package App\Mail
 */
class OrderServiceSent extends Mailable
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
     * @return OrderServiceSent
     */
    public function build(): OrderServiceSent
    {
        return $this->from(env('MAIL_FROM_ADDRESS'))
            ->subject('Форма: Заказать услугу')
            ->view('emails.order_service', [
                'data' => $this->data
            ]);
    }
}
