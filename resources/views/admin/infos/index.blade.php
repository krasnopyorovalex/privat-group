@extends('layouts.admin')

@section('breadcrumb')
    <li class="active">Новости</li>
@endsection

@section('content')

    <a href="{{ route('admin.infos.create') }}" type="button" class="btn bg-primary">
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
                <th>Создана</th>
                <th></th>
            </tr>
            </thead>
            <tbody>
            @foreach($infos as $info)
                <tr>
                    <td><span class="label label-primary">{{ $loop->iteration }}</span></td>
                    <td>{{ $info->name }}</td>
                    <td>{{ $info->alias }}</td>
                    <td><span class="label label-primary">{{ Illuminate\Support\Carbon::parse($info->published_at)->format('d M Y') }}</span></td>
                    <td>
                        <div>
                            <a href="{{ route('admin.infos.edit', $info) }}"><i class="icon-pencil7"></i></a>
                            <form method="POST" action="{{ route('admin.infos.destroy', $info) }}" class="form__delete">
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
