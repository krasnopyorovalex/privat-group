@extends('layouts.admin')

@section('breadcrumb')
    <li><a href="{{ route('admin.our_services.index') }}">Категории услуг</a></li>
    <li><a href="{{ route('admin.our_service_items.index', $ourServiceItem->our_service_id) }}">Список услуг</a></li>
    <li class="active">Форма редактирования услуги</li>
@endsection

@section('content')

    <div class="panel panel-default">
        <div class="panel-heading">Форма редактирования услуги</div>

        <div class="panel-body">

            @include('layouts.partials.errors')

                <div class="tabbable">
                    <ul class="nav nav-tabs">
                        <li class="active"><a href="#main" data-toggle="tab">Основное</a></li>
                        <li><a href="#images" data-toggle="tab">Галерея услуги</a></li>
                    </ul>

                    <div class="tab-content">
                        <div class="tab-pane active" id="main">
                            <form action="{{ route('admin.our_service_items.update', ['id' => $ourServiceItem->id]) }}" method="post" enctype="multipart/form-data">
                                @csrf
                                @method('put')

                                @input(['name' => 'name', 'label' => 'Название', 'entity' => $ourServiceItem])
                                @input(['name' => 'title', 'label' => 'Title', 'entity' => $ourServiceItem])
                                @input(['name' => 'description', 'label' => 'Description', 'entity' => $ourServiceItem])

                                @input(['name' => 'alias', 'label' => 'Alias', 'entity' => $ourServiceItem])

                                @textarea(['name' => 'text', 'label' => 'Текст', 'entity' => $ourServiceItem])

                                @submit_btn()
                            </form>
                        </div>
                        <div class="tab-pane" id="images">
                            <form action="#" enctype="multipart/form-data" method="post">
                                <div class="form-group">
                                    <div class="col-lg-12">
                                        <input type="hidden" name="ourServiceItemId" value="{{ $ourServiceItem->id }}">
                                        <input type="hidden" name="uploadUrl" value="{{ route('admin.our_service_item_images.store', $ourServiceItem) }}">
                                        <input type="hidden" name="updatePositionUrl" value="{{ route('admin.our_service_item_images.update_positions') }}">
                                        <input type="file" class="file-input-ajax" multiple="multiple" name="upload">
                                    </div>
                                </div>
                            </form>
                            <div class="clearfix"></div>
                            @if ($ourServiceItem->images)
                                <div id="_images_box">
                                    @include('admin.our_service_items._images_box')
                                </div>
                            @endif
                        </div>
                    </div>
                </div>

        </div>
    </div>

    <div id="edit-image" class="modal fade"></div>
    @push('scripts')
        <script src="{{ asset('dashboard/ckeditor/ckeditor.js') }}"></script>
        <script src="{{ asset('dashboard/assets/js/plugins/ui/dragula.min.js') }}"></script>
        <script src="{{ asset('dashboard/assets/js/pages/extension_dnd.js') }}"></script>
        <script src="{{ asset('dashboard/assets/js/plugins/uploaders/fileinput.min.js') }}"></script>
        <script src="{{ asset('dashboard/assets/js/pages/uploader_bootstrap.js') }}"></script>
    @endpush
@endsection
