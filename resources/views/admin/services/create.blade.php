@extends('layouts.admin')

@section('breadcrumb')
    <li><a href="{{ route('admin.services.index') }}">Номера</a></li>
    <li class="active">Форма добавления номера</li>
@endsection

@section('content')

    <div class="panel panel-default">
        <div class="panel-heading">Форма добавления номера</div>

        <div class="panel-body">

            @include('layouts.partials.errors')

            <form action="{{ route('admin.services.store') }}" method="post" enctype="multipart/form-data">
                @csrf

                <div class="tabbable">
                    <ul class="nav nav-tabs">
                        <li class="active"><a href="#main" data-toggle="tab">Основное</a></li>
                    </ul>

                    <div class="tab-content">
                        <div class="tab-pane active" id="main">

                            @select(['name' => 'gallery_id', 'label' => 'Галерея', 'items' => $galleries])

                            @input(['name' => 'name', 'label' => 'Название'])
                            @input(['name' => 'title', 'label' => 'Title'])
                            @input(['name' => 'description', 'label' => 'Description'])
                            @input(['name' => 'price', 'label' => 'Цена'])
                            @input(['name' => 'alias', 'label' => 'Alias'])

                            @imageInput(['name' => 'image', 'type' => 'file', 'label' => 'Выберите изображение на компьютере(300x230px)'])

                            @textarea(['name' => 'short_text', 'label' => 'Краткое описание', 'id' => 'editor-full2'])
                            @textarea(['name' => 'text', 'label' => 'Текст'])
                            @checkbox(['name' => 'is_published', 'label' => 'Опубликовано?', 'isChecked' => true])

                            <hr>
                            <h3>Вкладки</h3>

                            @foreach ($tabs as $tab)
                                <div class="form-group">
                                    <label for="editor-full-tab-{{ $tab->id }}">{{ $tab->name }}:</label>
                                    <textarea class="form-control border-blue border-xs tabs__editor" rows="" id="editor-full-tab-{{ $tab->id }}" name="tabs[{{ $tab->id }}]"></textarea>
                                </div>
                            @endforeach

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
                                                <option value="{{ $subService->id }}">{{ $subService->name }}</option>
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
@push('scripts')
<script src="{{ asset('dashboard/ckeditor/ckeditor.js') }}"></script>
@endpush
@endsection
