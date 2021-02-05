@extends('layouts.admin')

@section('breadcrumb')
    <li class="active">Города</li>
@endsection

@section('content')

    <a href="{{ route('admin.cities.create') }}" type="button" class="btn bg-primary">
        Добавить
        <i class="icon-stack-plus position-right"></i>
    </a>

    <div class="table-responsive">
        <table class="table">
            <thead>
            <tr class="border-solid">
                <th>#</th>
                <th>Название</th>
                <th>Alias</th>
                <th>Обновлен</th>
                <th></th>
            </tr>
            </thead>
            <tbody>
            @foreach($cities as $city)
                <tr>
                    <td><span class="label label-primary">{{ $loop->iteration }}</span></td>
                    <td>{{ $city->name }}</td>
                    <td>{{ $city->alias }}</td>
                    <td><span class="label label-primary">{{ $city->updated_at->diffForHumans() }}</span></td>
                    <td>
                        <div>
                            <a href="{{ route('admin.cities.edit', $city) }}"><i class="icon-pencil7"></i></a>
                            <form method="POST" action="{{ route('admin.cities.destroy', $city) }}" class="form__delete">
                                {{ csrf_field() }}
                                {{ method_field('DELETE') }}
                                <button type="submit" class="last__btn" data-alias="{{ $city->alias }}">
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