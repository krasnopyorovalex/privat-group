<?php

namespace App\Services;

use App\Domain\Article\Queries\GetAllArticlesQuery;
use App\Domain\Catalog\Queries\GetAllCatalogsQuery;
use App\Domain\Info\Queries\GetAllInfosQuery;
use App\Domain\OurService\Queries\GetAllOurServicesQuery;
use App\Domain\Project\Queries\GetAllProjectsQuery;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Bus\DispatchesJobs;

/**
 * Class TextParserService
 * @package App\Services
 */
class TextParserService
{
    use DispatchesJobs;

    private const PAGINATE_LIMIT = 10;

    /**
     * @param Model $entity
     * @return string|string[]|null
     */
    public function parse(Model $entity)
    {
        return preg_replace_callback_array(
            [
                '#(<p(.*)>)?{articles}(<\/p>)?#' => function () {
                    $articles = $this->dispatch(new GetAllArticlesQuery(true, self::PAGINATE_LIMIT));

                    return view('layouts.shortcodes.articles', ['articles' => $articles]);
                },
                '#(<p(.*)>)?{our_services}(<\/p>)?#' => function () {
                    $ourServices = $this->dispatch(new GetAllOurServicesQuery());

                    return view('layouts.shortcodes.our_services', ['ourServices' => $ourServices]);
                },
                '#(<p(.*)>)?{news}(<\/p>)?#' => function () {
                    $news = $this->dispatch(new GetAllInfosQuery(true, self::PAGINATE_LIMIT));

                    return view('layouts.shortcodes.news', ['news' => $news]);
                },
                '#(<p(.*)>)?{catalog}(<\/p>)?#' => function () {
                    $catalogs = $this->dispatch(new GetAllCatalogsQuery());

                    return view('layouts.shortcodes.catalogs', [
                        'catalogs' => $catalogs
                    ]);
                },
                '#(<p(.*)>)?{projects}(<\/p>)?#' => function () {
                    $projects = $this->dispatch(new GetAllProjectsQuery());

                    return view('layouts.shortcodes.projects', [
                        'projects' => $projects
                    ]);
                }
            ],
            $entity->text
        );
    }

}
