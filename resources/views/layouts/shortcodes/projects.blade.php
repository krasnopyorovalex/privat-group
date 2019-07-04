<div class="row">
    @foreach ($projects as $project)
        <div class="col-sm-6 col-lg-4 col-xs-12">
            <!-- Post Classic-->
            <article class="post post-classic box-md">
                @if($project->image)
                    <figure>
                        <a class="post-classic-figure" href="{{ $project->url }}">
                            <img src="{{ asset($project->image->path) }}" alt="" width="370" height="239">
                        </a>
                    </figure>
                @endif
                <div class="post-classic-content">
                    <h5 class="post-classic-title"><a href="{{ $project->url }}">{{ $project->name }}</a></h5>
                    <p class="post-classic-text">{!! strip_tags($project->preview) !!}</p>

                    <div class="btn__box text-center">
                        <a class="button button-sm button-secondary button-zakaria" href="{{ route('project.show', ['alias' => $project->alias]) }}">Подробнее</a>
                    </div>
                </div>
            </article>
        </div>
    @endforeach
</div>
