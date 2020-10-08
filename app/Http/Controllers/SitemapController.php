<?php

namespace App\Http\Controllers;

use App\Domain\Article\Queries\GetAllArticlesQuery;
use App\Domain\Catalog\Queries\GetAllCatalogsQuery;
use App\Domain\Info\Queries\GetAllInfosQuery;
use App\Domain\OurService\Queries\GetAllOurServicesQuery;
use App\Domain\Page\Queries\GetAllPagesQuery;
use App\Domain\Project\Queries\GetAllProjectsQuery;
use Illuminate\Http\Response;

/**
 * Class SitemapController
 * @package App\Http\Controllers
 */
class SitemapController extends Controller
{
    /**
     * @return Response
     */
    public function xml(): Response
    {
        $pages = $this->dispatch(new GetAllPagesQuery());
        $projects = $this->dispatch(new GetAllProjectsQuery());
        $articles = $this->dispatch(new GetAllArticlesQuery(true));
        $news = $this->dispatch(new GetAllInfosQuery(true));
        $ourServices = $this->dispatch(new GetAllOurServicesQuery());
        $catalog = $this->dispatch(new GetAllCatalogsQuery());

        return response()
            ->view('sitemap.index', [
                'pages' => $pages,
                'articles' => $articles,
                'projects' => $projects,
                'news' => $news,
                'ourServices' => $ourServices,
                'catalog' => $catalog
            ])
            ->header('Content-Type', 'text/xml');
    }
}
