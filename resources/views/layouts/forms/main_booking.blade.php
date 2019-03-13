<div class="main__booking-form">
    <form action="{{ route('send.booking') }}" method="post" id="form__booking-main">
        @csrf
        <div class="form__body">
            <div class="single__block">
                <label for="rooms">Категория номера:</label>
                <select name="room" id="rooms">
                    @foreach($services as $service)
                        <option value="{{ $service->name }}">{{ $service->name }}</option>
                    @endforeach
                </select>
                <i class="icon__arrow"></i>
            </div>
            <div class="single__block date">
                <div>
                    <label for="date_in">Дата заезда:</label>
                    <input type="text" name="date_in" id="date_in" class="date_in" autocomplete="off" required="">
                    <svg class="icon__calendar">
                        <use xlink:href="/img/symbols.svg#calendar"></use>
                    </svg>
                </div>
            </div>
            <div class="single__block date">
                <div>
                    <label for="date_out">Дата выезда:</label>
                    <input type="text" name="date_out" id="date_out" class="date_out" autocomplete="off" required="">
                    <svg class="icon__calendar">
                        <use xlink:href="/img/symbols.svg#calendar"></use>
                    </svg>
                </div>
            </div>
            <div class="single__block">
                <div>
                    <label for="count_adults">Кол-во взрослых:</label>
                    <select name="count_adults" id="count_adults">
                        <option value="1">1</option>
                        <option value="2">2</option>
                        <option value="3">3</option>
                        <option value="4">4</option>
                        <option value="5">5</option>
                    </select>
                    <i class="icon__arrow"></i>
                </div>
            </div>
            <div class="single__block">
                <div>
                    <label for="count_child">Кол-во детей:</label>
                    <select name="count_child" id="count_child">
                        <option value="">0</option>
                        <option value="1">1</option>
                        <option value="2">2</option>
                        <option value="3">3</option>
                        <option value="4">4</option>
                        <option value="5">5</option>
                    </select>
                    <i class="icon__arrow"></i>
                </div>
            </div>
            <div class="single__block">
                <label for="fio">ФИО:</label>
                <input type="text" name="fio" id="fio" autocomplete="off" required="">
            </div>
            <div class="single__block">
                <label for="phone">Телефон:</label>
                <input type="text" name="phone" id="phone" class="phone__mask" autocomplete="off" required="">
            </div>
            <div class="single__block">
                <label for="email">Email:</label>
                <input type="email" name="email" id="email" autocomplete="off" required="">
            </div>
            <div class="single__block message">
                <label for="dop__info">Дополнительная инфо:</label>
                <textarea name="dop__info" id="dop__info"></textarea>
            </div>
            <div class="single__block i__agree">
                <input type="checkbox" name="agree" id="i_agree" value="1" checked="checked">
                <label for="i_agree">Оставляя заявку, Вы соглашаетесь на <a href="{{ route('page.show', ['alias' => 'soglasie-na-obrabotku-personalnykh-dannykh']) }}" target="_blank" title="Перейти на страницу описания">обработку персональных данных</a></label>
                <p class="error">Согласитесь на обработку персональных данных</p>
            </div>
            <div class="single__block submit">
                <button type="submit" class="btn">Забронировать</button>
            </div>
        </div>
    </form>
</div>
