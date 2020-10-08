<form action="{{ route('admin.slider_images.update', ['id' => $image->id]) }}" method="post">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header bg-blue">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h6 class="modal-title">Метаданные изображения</h6>
            </div>
            <div class="modal-body">
                @csrf
                @method('put')

                @selectLink(['name' => 'link', 'entity' => $image, 'label' => 'Ссылка'])

                @input(['name' => 'name', 'label' => 'Верхний текст', 'entity' => $image])
                @input(['name' => 'alt', 'label' => 'Средний текст', 'entity' => $image])
                @input(['name' => 'title', 'label' => 'Текст кнопки', 'entity' => $image])
            </div>
            <div class="modal-footer">
                @submit_btn()
            </div>
        </div>
    </div>
</form>
