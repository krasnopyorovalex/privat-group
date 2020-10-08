@extends('layouts.admin')

@section('breadcrumb')
    <li><a href="{{ route('admin.advantages.index') }}">Наши преимущества</a></li>
    <li class="active">Форма редактирования преимущества</li>
@endsection

@section('content')

    <div class="panel panel-default">
        <div class="panel-heading">Форма редактирования преимущества</div>

        <div class="panel-body">

            @include('layouts.partials.errors')

            <div class="tabbable">
                <ul class="nav nav-tabs">
                    <li class="active"><a href="#main" data-toggle="tab">Основное</a></li>
                </ul>

                <div class="tab-content">
                    <div class="tab-pane active" id="main">
                        <form action="{{ route('admin.advantages.update', ['id' => $advantage->id]) }}" method="post" enctype="multipart/form-data">
                            @csrf
                            @method('put')

                            @input(['name' => 'name', 'label' => 'Название', 'entity' => $advantage])
                            @textarea(['name' => 'preview', 'label' => 'Превью', 'id' => 'editor-full2', 'entity' => $advantage])

                            @input(['name' => 'pos', 'label' => 'Позиция', 'entity' => $advantage])

                            @if ($advantage->image)
                                <div class="panel panel-flat border-blue border-xs advantage__image" id="image__box">
                                    <div class="panel-body">
                                        <img src="{{ asset($advantage->image->path) }}" alt="" class="upload__image icon__image">

                                        <div class="btn-group btn__actions">
                                            <button data-toggle="modal" data-target="#modal_info" type="button" class="btn btn-primary btn-labeled btn-sm"><b><i class="icon-pencil4"></i></b> Атрибуты</button>

                                            <button type="button" data-href="{{ route('admin.images.destroy', ['id' => $advantage->image->id]) }}" class="btn delete__img btn-danger btn-labeled btn-labeled-right btn-sm">Удалить <b><i class="icon-trash"></i></b></button>
                                        </div>
                                    </div>
                                </div>
                            @endif
                            @imageInput(['name' => 'image', 'type' => 'file', 'entity' => $advantage, 'label' => 'Выберите изображение на компьютере'])

                            @submit_btn()
                        </form>
                    </div>
                </div>
            </div>

        </div>
    </div>

    @if ($advantage->image)
        @include('layouts.partials._image_attributes_popup', ['image' => $advantage->image])
    @endif

    @push('scripts')
        <script src="{{ asset('dashboard/ckeditor/ckeditor.js') }}"></script>
    @endpush
@endsection
