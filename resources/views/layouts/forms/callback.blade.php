<div class="modal" tabindex="-1" role="dialog" id="callback">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Заполните форму. Мы свяжемся с Вами для уточнения времени и даты замера</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Закрыть">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form method="post" action="{{ route('send.callback') }}" id="form__order" onsubmit="yaCounter54461437.reachGoal('KONSULTACIA'); return true">
                    @csrf
                    <input type="hidden" name="product">
                    <div class="form-wrap">
                        <input class="form-input" type="text" name="name" minlength="3" autocomplete="off" placeholder="Имя" required=""/>
                    </div>
                    <div class="form-wrap">
                        <input class="form-input" type="text" name="phone" minlength="3" autocomplete="off" placeholder="Телефон" required=""/>
                    </div>
                    <div class="form-wrap agree__block">
                        <label class="checkbox-inline" for="i_agree-callback">
                            <input name="agree" value="1" checked type="checkbox" id="i_agree-callback">Согласие на обработку персональных данных
                            Оставляя заявку, Вы соглашаетесь на <a href="{{ route('page.show', ['alias' => 'personal-data']) }}" target="_blank" title="Перейти на страницу описания">обработку персональных данных</a>
                        </label>
                        <p class="error">Отметьте, пожалуйста</p>
                    </div>
                    <div class="submit">
                        <button class="button button-lg button-primary button-zakaria" type="submit">Заказать</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
