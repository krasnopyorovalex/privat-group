@extends('layouts.admin')

@section('breadcrumb')
    <li class="active">С нами работают</li>
@endsection

@section('content')

    <a href="{{ route('admin.partners.create') }}" type="button" class="btn bg-primary">
        Добавить
        <i class="icon-stack-plus position-right"></i>
    </a>

    <div class="table-responsive">
        <table class="table">
            <thead>
            <tr class="border-solid">
                <th>#</th>
                <th>Название</th>
                <th>Изображение</th>
                <th></th>
            </tr>
            </thead>
            <tbody>
            @foreach($partners as $partner)
                <tr>
                    <td><span class="label label-primary">{{ $loop->iteration }}</span></td>
                    <td>{{ $partner->name }}</td>
                    <td>@if ($partner->image)<img src="{{ asset($partner->image->path) }}" alt="" class="icon_small">@endif</td>
                    <td>
                        <div>
                            <a href="{{ route('admin.partners.edit', $partner) }}"><i class="icon-pencil7"></i></a>
                            <form method="POST" action="{{ route('admin.partners.destroy', $partner) }}" class="form__delete">
                                {{ csrf_field() }}
                                {{ method_field('DELETE') }}
                                <button type="submit" class="last__btn">
                                    <i class="icon-trash"></i>
                                </button>
                            </form>
                        </div>
                    </td>
                </tr>
            @endforeach
            </tbody>
        </table>
    </div>

@endsection