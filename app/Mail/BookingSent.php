<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

/**
 * Class BookingSent
 * @package App\Mail
 */
class BookingSent extends Mailable
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
     * @return BookingSent
     */
    public function build()
    {
        return $this->from('info@villa-sany.ru')
            ->subject('Форма: бронирование номера')
            ->view('emails.booking', [
                'data' => $this->data
            ]);
    }
}
