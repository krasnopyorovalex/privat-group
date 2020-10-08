<section class="booking">
    <div class="container">
        <div class="row">
            <div class="col-12">
                <form action="{{ route('send.cost') }}" class="check__availability" id="form__availability">
                    @csrf
                    <div class="row">
                        <div class="col-2">
                            <div class="check__availability-name">
                                Узнать стоимость
                            </div>
                        </div>
                        <div class="col-10">
                            <div class="single__block">
                                <label for="date_in">Дата приезда:</label>
                                <input type="text" name="date_in" id="date_in" class="date_in" autocomplete="off" required>
                                <svg class="icon__calendar">
                                    <use xlink:href="/img/symbols.svg#calendar"></use>
                                </svg>
                            </div>
                            <div class="single__block">
                                <label for="date_out">Дата выезда:</label>
                                <input type="text" name="date_out" id="date_out" class="date_out" autocomplete="off" required>
                                <svg class="icon__calendar">
                                    <use xlink:href="/img/symbols.svg#calendar"></use>
                                </svg>
                            </div>
                            <div class="single__block">
                                <label for="name">Имя:</label>
                                <input type="text" name="name" id="name" autocomplete="off" required>
                            </div>
                            <div class="single__block">
                                <label for="phone">Телефон:</label>
                                <input type="text" name="phone" id="phone" class="phone__mask" autocomplete="off" required>
                            </div>
                            <div class="single__block">
                                <label for="email">E-mail:</label>
                                <input type="email" name="email" id="email" autocomplete="off" required>
                            </div>
                            <div class="single__block submit">
                                <button type="submit" class="btn">Узнать</button>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</section>
