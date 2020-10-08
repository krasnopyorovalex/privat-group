@extends('layouts.admin')

@section('breadcrumb')
    <li class="active">Проекты</li>
@endsection

@section('content')

    <a href="{{ route('admin.projects.create') }}" type="button" class="btn bg-primary">
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
                <th></th>
            </tr>
            </thead>
            <tbody>
            @foreach($projects as $project)
                <tr>
                    <td><span class="label label-primary">{{ $loop->iteration }}</span></td>
                    <td>{{ $project->name }}</td>
                    <td>{{ $project->alias }}</td>
                    <td>
                        <div>
                            <a href="{{ route('admin.projects.edit', $project) }}"><i class="icon-pencil7"></i></a>
                            <form method="POST" action="{{ route('admin.projects.destroy', $project) }}" class="form__delete">
                                {{ csrf_field() }}
                                {{ method_field('DELETE') }}
                                <button type="submit" class="last__btn" data-alias="{{ $project->alias }}">
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
