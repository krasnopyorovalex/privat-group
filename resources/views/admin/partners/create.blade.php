@extends('layouts.admin')

@section('breadcrumb')
    <li><a href="{{ route('admin.partners.index') }}">С нами работают</a></li>
    <li class="active">Форма добавления партнёра</li>
@endsection

@section('content')

    <div class="panel panel-default">
        <div class="panel-heading">Форма добавления партнёра</div>

        <div class="panel-body">

            @include('layouts.partials.errors')

            <form action="{{ route('admin.partners.store') }}" method="post" enctype="multipart/form-data">
                @csrf

                @input(['name' => 'name', 'label' => 'Название'])
                @imageInput(['name' => 'image', 'type' => 'file', 'label' => 'Выберите изображение на компьютере'])

                @submit_btn()
            </form>

        </div>
    </div>

@endsection