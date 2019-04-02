<div class="sb__guest-form">
    <div class="title">Напишите нам отзыв</div>
    <form action="{{ route('send.guestbook') }}" method="post" id="form__guest">
        @csrf
        <div class="form__body">
            <div class="single__block">
                <div class="single__block">
                    <label for="fio">Имя*:</label>
                    <input type="text" name="name" id="fio" autocomplete="off" required="">
                </div>
{{--                <div class="single__block">--}}
{{--                    <label for="email">Email*:</label>--}}
{{--                    <input type="email" name="email" id="email" autocomplete="off" required="">--}}
{{--                </div>--}}
                <div class="single__block">
                    <label for="dop__info">Текст отзыва*:</label>
                    <textarea name="text" id="dop__info" required=""></textarea>
                </div>
                <div class="single__block i__agree">
                    <input type="checkbox" name="agree" id="i_agree" value="1" checked="checked">
                    <label for="i_agree">Оставляя заявку, Вы соглашаетесь на <a href="{{ route('page.show', ['alias' => 'soglasie-na-obrabotku-personalnykh-dannykh']) }}" target="_blank" title="Перейти на страницу описания">обработку персональных данных</a></label>
                    <p class="error">Согласитесь на обработку персональных данных</p>
                </div>
                <div class="single__block submit">
                    <button type="submit" class="btn">Отправить отзыв</button>
                </div>
            </div>
        </div>
    </form>
</div>
