<?php

namespace App\Http\Controllers;

use App\Domain\Article\Queries\GetAllArticlesQuery;
use App\Domain\Info\Queries\GetAllInfosQuery;
use App\Domain\OurService\Queries\GetAllOurServicesQuery;
use App\Domain\Page\Queries\GetAllPagesQuery;
use App\Domain\Service\Queries\GetAllServicesQuery;

/**
 * Class SitemapController
 * @package App\Http\Controllers
 */
class SitemapController extends Controller
{
    /**
     * @return \Illuminate\Http\Response
     */
    public function xml()
    {
        $pages = $this->dispatch(new GetAllPagesQuery());
        $articles = $this->dispatch(new GetAllArticlesQuery(true));
        $services = $this->dispatch(new GetAllServicesQuery());
        $news = $this->dispatch(new GetAllInfosQuery(true));
        $ourServices = $this->dispatch(new GetAllOurServicesQuery());

        return response()
            ->view('sitemap.index', [
                'pages' => $pages,
                'articles' => $articles,
                'services' => $services,
                'news' => $news,
                'ourServices' => $ourServices
            ], 200)
            ->header('Content-Type', 'text/xml');
    }
}
