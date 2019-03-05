@extends('layouts.admin')

@section('breadcrumb')
    <li><a href="{{ route('admin.services.index') }}">Номера</a></li>
    <li class="active">Форма редактирования номера</li>
@endsection

@section('content')

    <div class="panel panel-default">
        <div class="panel-heading">Форма редактирования номера</div>

        <div class="panel-body">

            @include('layouts.partials.errors')

            <form action="{{ route('admin.services.update', ['id' => $service->id]) }}" method="post" enctype="multipart/form-data">
                @csrf
                @method('put')

                <div class="tabbable">
                    <ul class="nav nav-tabs">
                        <li class="active"><a href="#main" data-toggle="tab">Основное</a></li>
                        <li><a href="#image" data-toggle="tab">Изображение</a></li>
                    </ul>

                    <div class="tab-content">
                        <div class="tab-pane active" id="main">

                            @select(['name' => 'gallery_id', 'label' => 'Галерея', 'items' => $galleries, 'entity' => $service])

                            @input(['name' => 'name', 'label' => 'Название', 'entity' => $service])
                            @input(['name' => 'title', 'label' => 'Title', 'entity' => $service])
                            @input(['name' => 'description', 'label' => 'Description', 'entity' => $service])

                            @input(['name' => 'price', 'label' => 'Цена', 'entity' => $service])
                            @input(['name' => 'alias', 'label' => 'Alias', 'entity' => $service])

                            @textarea(['name' => 'short_text', 'label' => 'Краткое описание', 'entity' => $service, 'id' => 'editor-full2'])
                            @textarea(['name' => 'text', 'label' => 'Текст', 'entity' => $service])
                            @checkbox(['name' => 'is_published', 'label' => 'Опубликовано?', 'entity' => $service])

                            @if(count($tabs))
                                <hr>
                                <h3>Вкладки</h3>

                                @foreach ($tabs as $tab)
                                    <div class="form-group">
                                        <label for="editor-full-tab-{{ $tab->id }}">{{ $tab->name }}:</label>
                                        <textarea class="form-control border-blue border-xs tabs__editor" rows="" id="editor-full-tab-{{ $tab->id }}" name="tabs[{{ $tab->id }}]">{{ $service->tabs[$tab->id] ?? '' }}</textarea>
                                    </div>
                                @endforeach
                            @endif

                            @submit_btn()
                        </div>
                        <div class="tab-pane" id="image">
                            @if ($service->image)
                                <div class="panel panel-flat border-blue border-xs" id="image__box">
                                    <div class="panel-body">
                                        <img src="{{ asset($service->image->path) }}" alt="" class="upload__image">

                                        <div class="btn-group btn__actions">
                                            <button data-toggle="modal" data-target="#modal_info" type="button" class="btn btn-primary btn-labeled btn-sm"><b><i class="icon-pencil4"></i></b> Атрибуты</button>

                                            <button type="button" data-href="{{ route('admin.images.destroy', ['id' => $service->image->id]) }}" class="btn delete__img btn-danger btn-labeled btn-labeled-right btn-sm">Удалить <b><i class="icon-trash"></i></b></button>
                                        </div>
                                    </div>
                                </div>
                            @endif
                            @imageInput(['name' => 'image', 'type' => 'file', 'entity' => $service, 'label' => 'Выберите изображение на компьютере(300x230px)'])
                            @submit_btn()
                        </div>
                        <div class="tab-pane" id="related">
                            <div class="form-group">
                                <label for="services">Выберите сопутствующие туры</label>
                                <select class="form-control border-blue border-xs select-search" multiple="multiple" id="services" name="services[]" data-width="100%">
                                    @foreach($services as $s)
                                        @if ($s->services)
                                            <optgroup label="{{ $s->name }}">
                                                @foreach ($s->services as $subService)
                                                    @if ($subService->id !== $service->id)
                                                    <option value="{{ $subService->id }}" {{ in_array($subService->id, $serviceRelatives) ? 'selected' : '' }}>{{ $subService->name }}</option>
                                                    @endif
                                                @endforeach
                                            </optgroup>
                                        @endif
                                    @endforeach
                                </select>
                            </div>
                            @submit_btn()
                        </div>
                    </div>
                </div>
            </form>

        </div>
    </div>
    @if ($service->image)
        @include('layouts.partials._image_attributes_popup', ['image' => $service->image])
    @endif
@push('scripts')
<script src="{{ asset('dashboard/ckeditor/ckeditor.js') }}"></script>
@endpush
@endsection
