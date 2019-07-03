@extends('layouts.admin')

@section('breadcrumb')
    <li><a href="{{ route('admin.our_services.index') }}">Услуги</a></li>
    <li class="active">Форма редактирования услуги</li>
@endsection

@section('content')

    <div class="panel panel-default">
        <div class="panel-heading">Форма редактирования услуги</div>

        <div class="panel-body">

            @include('layouts.partials.errors')

            <form action="{{ route('admin.our_services.update', ['id' => $ourService->id]) }}" method="post" enctype="multipart/form-data">
                @csrf
                @method('put')

                <div class="tabbable">
                    <ul class="nav nav-tabs">
                        <li class="active"><a href="#main" data-toggle="tab">Основное</a></li>
                        <li><a href="#image" data-toggle="tab">Изображение</a></li>
                    </ul>

                    <div class="tab-content">
                        <div class="tab-pane active" id="main">
                            <div class="row">
                                <div class="col-md-12">

                                    @input(['name' => 'name', 'label' => 'Название', 'entity' => $ourService])
                                </div>
                            </div>
                        </div>

                        <div class="tab-pane" id="image">
                            @if ($ourService->image)
                                <div class="panel panel-flat border-blue border-xs" id="image__box">
                                    <div class="panel-body">
                                        <img src="{{ asset($ourService->image->path) }}" alt="" class="upload__image">

                                        <div class="btn-group btn__actions">
                                            <button data-toggle="modal" data-target="#modal_info" type="button" class="btn btn-primary btn-labeled btn-sm"><b><i class="icon-pencil4"></i></b> Атрибуты</button>

                                            <button type="button" data-href="{{ route('admin.images.destroy', ['id' => $ourService->image->id]) }}" class="btn delete__img btn-danger btn-labeled btn-labeled-right btn-sm">Удалить <b><i class="icon-trash"></i></b></button>
                                        </div>
                                    </div>
                                </div>
                            @endif
                            @imageInput(['name' => 'image', 'type' => 'file', 'entity' => $ourService, 'label' => 'Выберите изображение на компьютере'])
                            @submit_btn()
                        </div>
                    </div>
                </div>
            </form>

        </div>
    </div>
    @if ($ourService->image)
        @include('layouts.partials._image_attributes_popup', ['image' => $ourService->image])
    @endif
@endsection
