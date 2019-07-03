@extends('layouts.admin')

@section('breadcrumb')
    <li class="active">Наши услуги</li>
@endsection

@section('content')

    <a href="{{ route('admin.our_services.create') }}" type="button" class="btn bg-primary">
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
            @foreach($ourServices as $ourService)
                <tr>
                    <td><span class="label label-primary">{{ $loop->iteration }}</span></td>
                    <td>{{ $ourService->name }}</td>
                    <td>{{ $ourService->alias }}</td>
                    <td>
                        <div>
                            <a href="{{ route('admin.our_services.edit', $ourService) }}"><i class="icon-pencil7"></i></a>
                            <a href="{{ route('admin.our_service_items.index', $ourService) }}" data-original-title="Услуги" data-popup="tooltip"><i class="icon-lan2"></i></a>
                            <form method="POST" action="{{ route('admin.our_services.destroy', $ourService) }}" class="form__delete">
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
