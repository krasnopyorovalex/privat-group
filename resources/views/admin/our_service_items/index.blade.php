@extends('layouts.admin')

@section('breadcrumb')
    <li><a href="{{ route('admin.our_services.index') }}">Категории услуг</a></li>
    <li class="active">Услуги</li>
@endsection

@section('content')

    <a href="{{ route('admin.our_service_items.create', ['our_service' => $ourService]) }}" type="button" class="btn bg-primary">
        Добавить
        <i class="icon-stack-plus position-right"></i>
    </a>

    <div class="table-responsive">
        <table class="table">
            <thead>
            <tr class="border-solid">
                <th>#</th>
                <th>Название</th>
                <th>Категория</th>
                <th></th>
            </tr>
            </thead>
            <tbody id="table__dnd">
            @foreach($ourServiceItems as $ourServiceItem)
                <tr data-id="{{ $ourServiceItem->id }}">
                    <td><span class="label label-primary">{{ $loop->iteration }}</span></td>
                    <td>{{ $ourServiceItem->name }}</td>
                    <td><span class="label label-primary bg-teal-400">{{ $ourServiceItem->ourService->name }}</span></td>
                    <td>
                        <div>
                            <a href="{{ route('admin.our_service_items.edit', $ourServiceItem) }}"><i class="icon-pencil7"></i></a>
                            <form method="POST" action="{{ route('admin.our_service_items.destroy', $ourServiceItem) }}" class="form__delete">
                                {{ csrf_field() }}
                                {{ method_field('DELETE') }}
                                <input type="hidden" value="{{ $ourServiceItem->our_service_id }}" name="our_service_id">
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
