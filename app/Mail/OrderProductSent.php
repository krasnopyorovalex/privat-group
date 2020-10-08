<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

/**
 * Class OrderProductSent
 * @package App\Mail
 */
class OrderProductSent extends Mailable
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
     * @return OrderProductSent
     */
    public function build(): OrderProductSent
    {
        return $this->from(env('MAIL_FROM_ADDRESS'))
            ->subject('Форма: Заказать баню')
            ->view('emails.order_product', [
                'data' => $this->data
            ]);
    }
}
