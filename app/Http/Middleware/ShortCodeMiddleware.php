<?php

namespace App\Http\Middleware;

use App\Domain\Article\Queries\GetAllArticlesQuery;
use App\Domain\Catalog\Queries\GetAllCatalogsQuery;
use App\Domain\City\Queries\GetAllCitiesQuery;
use App\Domain\Info\Queries\GetAllInfosQuery;
use App\Domain\OurService\Queries\GetAllOurServicesQuery;
use App\Domain\Page\Queries\GetAllPagesQuery;
use App\Domain\Project\Queries\GetAllProjectsQuery;
use Closure;
use Illuminate\Http\Response;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Http\Request;

class ShortCodeMiddleware
{
    use DispatchesJobs;

    /**
     * Handle an incoming request.
     *
     * @param Request $request
     * @param Closure $next
     * @return Response
     */
    public function handle(Request $request, Closure $next): Response
    {
        /** @var $response Response */
        $response = $next($request);

        if ( ! method_exists($response, 'content')) {
            return $response;
        }

        $content = preg_replace_callback_array(
            [
                '#(<p(.*)>)?{sitemap}(<\/p>)?#' => function () {
                    $pages = $this->dispatch(new GetAllPagesQuery());
                    $projects = $this->dispatch(new GetAllProjectsQuery());
                    $articles = $this->dispatch(new GetAllArticlesQuery(true));
                    $news = $this->dispatch(new GetAllInfosQuery(true));
                    $ourServices = $this->dispatch(new GetAllOurServicesQuery());
                    $catalog = $this->dispatch(new GetAllCatalogsQuery());
                    $cities = $this->dispatch(new GetAllCitiesQuery());

                    return view('layouts.shortcodes.sitemap', [
                        'pages' => $pages,
                        'articles' => $articles,
                        'projects' => $projects,
                        'news' => $news,
                        'ourServices' => $ourServices,
                        'catalog' => $catalog,
                        'cities' => $cities
                    ]);
                }
            ],
            $response->content()
        );

        $response->setContent($content);

        return $response;
    }
}
