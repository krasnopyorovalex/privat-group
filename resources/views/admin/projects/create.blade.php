@extends('layouts.admin')

@section('breadcrumb')
    <li><a href="{{ route('admin.projects.index') }}">Проекты</a></li>
    <li class="active">Форма добавления проекта</li>
@endsection

@section('content')

    <div class="panel panel-default">
        <div class="panel-heading">Форма добавления проекта</div>

        <div class="panel-body">

            @include('layouts.partials.errors')

            <form action="{{ route('admin.projects.store') }}" method="post" enctype="multipart/form-data">
                @csrf

                <div class="row">
                    <div class="col-md-12">
                        @input(['name' => 'name', 'label' => 'Название'])
                        @input(['name' => 'title', 'label' => 'Title'])
                        @input(['name' => 'description', 'label' => 'Description'])

                        @input(['name' => 'alias', 'label' => 'Alias'])
                        @imageInput(['name' => 'image', 'type' => 'file', 'label' => 'Выберите изображение на компьютере'])
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-12">
                        @textarea(['name' => 'preview', 'label' => 'Превью', 'id' => 'editor-full2'])
                        @textarea(['name' => 'text', 'label' => 'Текст'])

                        @submit_btn()
                    </div>
                </div>
            </form>

        </div>
    </div>
@push('scripts')
<script src="{{ asset('dashboard/ckeditor/ckeditor.js') }}"></script>
@endpush
@endsection
