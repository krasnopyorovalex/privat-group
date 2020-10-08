@extends('layouts.admin')

@section('breadcrumb')
    <li><a href="{{ route('admin.projects.index') }}">Проекты</a></li>
    <li class="active">Форма редактирования проекта</li>
@endsection

@section('content')

    <div class="panel panel-default">
        <div class="panel-heading">Форма редактирования проекта</div>

        <div class="panel-body">

            @include('layouts.partials.errors')
                <div class="tabbable">
                    <ul class="nav nav-tabs">
                        <li class="active"><a href="#main" data-toggle="tab">Основное</a></li>
                        <li><a href="#images" data-toggle="tab">Галерея проекта</a></li>
                    </ul>

                    <div class="tab-content">
                        <div class="tab-pane active" id="main">
                            <form action="{{ route('admin.projects.update', ['id' => $project->id]) }}" method="post" enctype="multipart/form-data">
                            @csrf
                            @method('put')

                            <div class="row">
                                <div class="col-md-8">
                                    @input(['name' => 'name', 'label' => 'Название', 'entity' => $project])
                                    @input(['name' => 'title', 'label' => 'Title', 'entity' => $project])
                                    @input(['name' => 'description', 'label' => 'Description', 'entity' => $project])

                                    @input(['name' => 'alias', 'label' => 'Alias', 'entity' => $project])
                                </div>
                                <div class="col-md-4">
                                    @if ($project->image)
                                        <div class="panel panel-flat border-blue border-xs" id="image__box">
                                            <div class="panel-body">
                                                <img src="{{ asset($project->image->path) }}" alt="" class="upload__image">

                                                <div class="btn-group btn__actions">
                                                    <button data-toggle="modal" data-target="#modal_info" type="button" class="btn btn-primary btn-labeled btn-sm"><b><i class="icon-pencil4"></i></b> Атрибуты</button>

                                                    <button type="button" data-href="{{ route('admin.images.destroy', ['id' => $project->image->id]) }}" class="btn delete__img btn-danger btn-labeled btn-labeled-right btn-sm">Удалить <b><i class="icon-trash"></i></b></button>
                                                </div>
                                            </div>
                                        </div>
                                    @endif
                                    @imageInput(['name' => 'image', 'type' => 'file', 'entity' => $project, 'label' => 'Выберите изображение на компьютере'])
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-12">
                                    @textarea(['name' => 'preview', 'label' => 'Превью', 'entity' => $project, 'id' => 'editor-full2'])
                                    @textarea(['name' => 'text', 'label' => 'Текст', 'entity' => $project])

                                    @submit_btn()
                                </div>
                            </div>
                            </form>
                        </div>

                        <div class="tab-pane" id="images">
                            <form action="#" enctype="multipart/form-data" method="post">
                                <div class="form-group">
                                    <div class="col-lg-12">
                                        <input type="hidden" name="projectId" value="{{ $project->id }}">
                                        <input type="hidden" name="uploadUrl" value="{{ route('admin.project_images.store', $project) }}">
                                        <input type="hidden" name="updatePositionUrl" value="{{ route('admin.project_images.update_positions') }}">
                                        <input type="file" class="file-input-ajax" multiple="multiple" name="upload">
                                    </div>
                                </div>
                            </form>
                            <div class="clearfix"></div>
                            @if ($project->images)
                                <div id="_images_box">
                                    @include('admin.projects._images_box')
                                </div>
                            @endif
                        </div>
                    </div>
                </div>
        </div>
    </div>
    @if ($project->image)
        @include('layouts.partials._image_attributes_popup', ['image' => $project->image])
    @endif

    <div id="edit-image" class="modal fade"></div>
    @push('scripts')
        <script src="{{ asset('dashboard/ckeditor/ckeditor.js') }}"></script>
        <script src="{{ asset('dashboard/assets/js/plugins/ui/dragula.min.js') }}"></script>
        <script src="{{ asset('dashboard/assets/js/pages/extension_dnd.js') }}"></script>
        <script src="{{ asset('dashboard/assets/js/plugins/uploaders/fileinput.min.js') }}"></script>
        <script src="{{ asset('dashboard/assets/js/pages/uploader_bootstrap.js') }}"></script>
    @endpush
@endsection
