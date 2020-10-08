@extends('layouts.admin')

@section('breadcrumb')
    <li class="active">Наши преимущества</li>
@endsection

@section('content')

    <a href="{{ route('admin.advantages.create') }}" type="button" class="btn bg-primary">
        Добавить
        <i class="icon-stack-plus position-right"></i>
    </a>

    <div class="table-responsive">
        <table class="table">
            <thead>
            <tr class="border-solid">
                <th>#</th>
                <th>Название</th>
                <th></th>
            </tr>
            </thead>
            <tbody>
            @foreach($advantages as $advantage)
                <tr>
                    <td><span class="label label-primary">{{ $loop->iteration }}</span></td>
                    <td>{{ $advantage->name }}</td>
                    <td>
                        <div>
                            <a href="{{ route('admin.advantages.edit', $advantage) }}"><i class="icon-pencil7"></i></a>
                            <form method="POST" action="{{ route('admin.advantages.destroy', $advantage) }}" class="form__delete">
                                {{ csrf_field() }}
                                {{ method_field('DELETE') }}
                                <button type="submit" class="last__btn" data-alias="{{ $advantage->alias }}">
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
