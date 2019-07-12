<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

/**
 * Class OrderServiceItemSent
 * @package App\Mail
 */
class OrderServiceItemSent extends Mailable
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
     * @return OrderServiceItemSent
     */
    public function build(): OrderServiceItemSent
    {
        return $this->from('bani.crimea@yandex.ru')
            ->subject('Форма: Заказать услугу')
            ->view('emails.order_service', [
                'data' => $this->data
            ]);
    }
}
