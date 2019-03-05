<?php

namespace App\Services;

use App\Domain\Article\Queries\GetAllArticlesQuery;
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
                '#(<p(.*)>)?{rooms}(<\/p>)?#' => function () use ($entity) {
                    return view('layouts.shortcodes.rooms');
                },
                '#(<p(.*)>)?{articles}(<\/p>)?#' => function () use ($entity) {
                    $articles = $this->dispatch(new GetAllArticlesQuery(self::PAGINATE_LIMIT));

                    return view('layouts.shortcodes.articles', ['articles' => $articles]);
                },
                '#(<p(.*)>)?{form_booking}(<\/p>)?#' => function () use ($entity) {
                    return view('layouts.forms.main_booking');
                }
            ],
            $entity->text
        );
    }

}
