<?php

namespace App\Http\Controllers;

use App\Domain\Guestbook\Commands\CreateGuestbookCommand;
use App\Http\Requests\Forms\BookingRequest;
use App\Http\Requests\Forms\GuestbookCheckRequest;
use App\Http\Requests\Forms\CostRequest;
use App\Mail\BookingSent;
use App\Mail\CostSent;
use Illuminate\Support\Facades\Mail;
use Illuminate\Foundation\Bus\DispatchesJobs;

/**
 * Class FormHandlerController
 * @package App\Http\Controllers
 */
class FormHandlerController extends Controller
{
    use DispatchesJobs;

    private $to = 'djShtaket88@mail.ru';

    /**
     * @param CostRequest $request
     * @return array
     */
    public function cost(CostRequest $request): array
    {
        Mail::to([$this->to])->send(new CostSent($request->all()));

        return [
            'message' => 'Благодарим за Вашу заявку. Наш менеджер свяжется с Вами в ближайшее время',
            'status' => 200
        ];
    }

    /**
     * @param BookingRequest $request
     * @return array
     */
    public function booking(BookingRequest $request): array
    {
        Mail::to([$this->to])->send(new BookingSent($request->all()));

        return [
            'message' => 'Благодарим за Вашу заявку. Наш менеджер свяжется с Вами в ближайшее время',
            'status' => 200
        ];
    }

    /**
     * @param GuestbookCheckRequest $request
     * @return array
     */
    public function guestbook(GuestbookCheckRequest $request): array
    {
        $this->dispatch(new CreateGuestbookCommand($request));

        return [
            'message' => 'Спасибо за Ваш отзыв!',
            'status' => 200
        ];
    }
}
