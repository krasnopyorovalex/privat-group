@extends('layouts.admin')

@section('breadcrumb')
    <li><a href="{{ route('admin.cities.index') }}">Города</a></li>
    <li class="active">Форма редактирования города</li>
@endsection

@section('content')

    <div class="panel panel-default">
        <div class="panel-heading">Форма редактирования города</div>

        <div class="panel-body">

            @include('layouts.partials.errors')

            <form action="{{ route('admin.cities.update', ['id' => $city->id]) }}" method="post" enctype="multipart/form-data">
                @csrf
                @method('put')

                <div class="tabbable">
                    <ul class="nav nav-tabs">
                        <li class="active"><a href="#main" data-toggle="tab">Основное</a></li>
                    </ul>

                    <div class="tab-content">
                        <div class="tab-pane active" id="main">
                            @input(['name' => 'name', 'label' => 'Название', 'entity' => $city])
                            @input(['name' => 'title', 'label' => 'Title', 'entity' => $city])
                            @input(['name' => 'description', 'label' => 'Description', 'entity' => $city])
                            @input(['name' => 'alias', 'label' => 'Alias', 'entity' => $city])
                            @textarea(['name' => 'text', 'label' => 'Текст', 'entity' => $city])
                            @checkbox(['name' => 'is_published', 'label' => 'Опубликовано?', 'entity' => $city])

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
