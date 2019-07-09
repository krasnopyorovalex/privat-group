<?php

namespace App\Http\Controllers;

use App\Http\Requests\Forms\OrderRequest;
use App\Http\Requests\Forms\QuestionRequest;
use App\Http\Requests\Forms\SubscribeRequest;
use App\Mail\OrderSent;
use App\Mail\QuestionSent;
use App\Mail\SubscribeSent;
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
     * @param SubscribeRequest $request
     * @return array
     */
    public function subscribe(SubscribeRequest $request): array
    {
        Mail::to([$this->to])->send(new SubscribeSent($request->all()));

        return [
            'message' => 'Форма отправлена успешно. Наш менеджер свяжется с Вами в ближайшее время',
            'status' => 200
        ];
    }

    /**
     * @param OrderRequest $request
     * @return array
     */
    public function order(OrderRequest $request): array
    {
        Mail::to([$this->to])->send(new OrderSent($request->all()));

        return [
            'message' => 'Форма отправлена успешно. Наш менеджер свяжется с Вами в ближайшее время',
            'status' => 200
        ];
    }

    /**
     * @param QuestionRequest $request
     * @return array
     */
    public function question(QuestionRequest $request): array
    {
        Mail::to([$this->to])->send(new QuestionSent($request->all()));

        return [
            'message' => 'Форма отправлена успешно. Наш менеджер свяжется с Вами в ближайшее время',
            'status' => 200
        ];
    }
}
