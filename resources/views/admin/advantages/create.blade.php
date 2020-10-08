@extends('layouts.admin')

@section('breadcrumb')
    <li><a href="{{ route('admin.advantages.index') }}">Наши преимущества</a></li>
    <li class="active">Форма добавления преимущества</li>
@endsection

@section('content')

    <div class="panel panel-default">
        <div class="panel-heading">Форма добавления преимущества</div>
            <div class="panel-body">

                @include('layouts.partials.errors')

                <div class="tabbable">
                    <ul class="nav nav-tabs">
                        <li class="active"><a href="#main" data-toggle="tab">Основное</a></li>
                    </ul>

                    <div class="tab-content">
                        <div class="tab-pane active" id="main">
                            <form action="{{ route('admin.advantages.store') }}" method="post" enctype="multipart/form-data">
                                @csrf

                                @input(['name' => 'name', 'label' => 'Название'])
                                @imageInput(['name' => 'image', 'type' => 'file', 'label' => 'Выберите изображение на компьютере'])
                                @textarea(['name' => 'preview', 'label' => 'Превью', 'id' => 'editor-full2'])

                                @input(['name' => 'pos', 'label' => 'Позиция'])

                                @submit_btn()
                            </form>
                        </div>
                    </div>
                </div>
            </div>
    </div>
    @push('scripts')
        <script src="{{ asset('dashboard/ckeditor/ckeditor.js') }}"></script>
    @endpush
@endsection
