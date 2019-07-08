<div class="modal" tabindex="-1" role="dialog" id="order">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Форма заказа - <span class="product_name"></span></h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form method="post" action="{{ route('send.order') }}" id="form__order">
                    @csrf
                    <input type="hidden" name="product">
                    <div class="form-wrap">
                        <input class="form-input" id="contact-name" type="text" name="name" autocomplete="off" placeholder="Имя"/>
                    </div>
                    <div class="form-wrap">
                        <input class="form-input" id="contact-phone" type="text" name="phone" autocomplete="off" placeholder="Телефон"/>
                    </div>
                    <button class="button button-lg button-primary button-zakaria" type="submit">Заказать</button>
                </form>
            </div>
        </div>
    </div>
</div>
