<?php

namespace App\Http\Controllers;

use App\Domain\Article\Queries\GetAllArticlesQuery;
use App\Domain\Info\Queries\GetAllInfosQuery;
use App\Domain\OurService\Queries\GetAllOurServicesQuery;
use App\Domain\Page\Queries\GetAllPagesQuery;
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
        $articles = $this->dispatch(new GetAllArticlesQuery(true));
        $news = $this->dispatch(new GetAllInfosQuery(true));
        $ourServices = $this->dispatch(new GetAllOurServicesQuery());

        return response()
            ->view('sitemap.index', [
                'pages' => $pages,
                'articles' => $articles,
                'news' => $news,
                'ourServices' => $ourServices
            ])
            ->header('Content-Type', 'text/xml');
    }
}
