@extends('layouts.admin')

@section('breadcrumb')
    <li><a href="{{ route('admin.partners.index') }}"> нами работают</a></li>
    <li class="active">Форма редактирования партнёра</li>
@endsection

@section('content')

    <div class="panel panel-default">
        <div class="panel-heading">Форма редактирования партнёра</div>

        <div class="panel-body">

            @include('layouts.partials.errors')

            <form action="{{ route('admin.partners.update', $partner) }}" method="post" enctype="multipart/form-data">
                @csrf
                @method('put')

                @input(['name' => 'name', 'label' => 'Название', 'entity' => $partner])

                @if ($partner->image)
                    <div class="panel panel-flat border-blue border-xs" id="image__box">
                        <div class="panel-body">
                            <img src="{{ asset($partner->image->path) }}" alt="" class="upload__image">

                            <div class="btn-group btn__actions">
                                <button data-toggle="modal" data-target="#modal_info" type="button" class="btn btn-primary btn-labeled btn-sm"><b><i class="icon-pencil4"></i></b> Атрибуты</button>

                                <button type="button" data-href="{{ route('admin.images.destroy', ['id' => $partner->image->id]) }}" class="btn delete__img btn-danger btn-labeled btn-labeled-right btn-sm">Удалить <b><i class="icon-trash"></i></b></button>
                            </div>
                        </div>
                    </div>
                @endif
                @imageInput(['name' => 'image', 'type' => 'file', 'entity' => $partner, 'label' => 'Выберите изображение на компьютере'])

                @submit_btn()

            </form>

        </div>
    </div>
@if ($partner->image)
    @include('layouts.partials._image_attributes_popup', ['image' => $partner->image])
@endif

@endsection