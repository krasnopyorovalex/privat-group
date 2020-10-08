<?php

namespace App\Console\Commands;

use App\Catalog;
use App\CatalogProduct;
use App\Image;
use File;
use Illuminate\Console\Command;
use Illuminate\Support\Str;
use Storage;
use Symfony\Component\DomCrawler\Crawler;
use Intervention\Image\ImageManager;

class CatalogFiveDbSeeder extends Command
{
    private const BASE_URL = 'https://www.teplodar.ru';

    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'command:catalog-five';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Set to db catalog and items from source site url';

    /**
     * @throws \Exception
     */
    public function handle()
    {
        $document = file_get_contents(app_path('Console/Commands/data/teplodar.html'));

        $crawler = new Crawler($document);

        $categories = $crawler->filter('.vertical-menu-box .vertical-menu-item > li')->each(static function (Crawler $node) {

            $link = $node->filter('a.notselected')->first();

            $child = $node->filter('.vertical-submenu')->first()->filter('li')->each(static function (Crawler $node) {

                $link = $node->filter('a')->first();

                return [
                    'name' => trim($link->text()),
                    'link' => $link->attr('href'),
                ];
            });

            return [
                'name' => trim($link->text()),
                'link' => $link->attr('href'),
                'child' => $child
            ];
        });

        $categories = array_slice($categories,0,4);

        foreach ($categories as $category) {

            $existsCatalog = Catalog::where('alias', 'teplodar-'.str_slug($category['name']))->first();

            if ($existsCatalog) {

                foreach ($category['child'] as $child) {
                    $this->parseItems($child['link'], $existsCatalog->id);
                    $this->parseItems($child['link']. '?PAGEN_2=2', $existsCatalog->id);
                    $this->parseItems($child['link']. '?PAGEN_2=3', $existsCatalog->id);
                    $this->parseItems($child['link']. '?PAGEN_2=4', $existsCatalog->id);
                    $this->parseItems($child['link']. '?PAGEN_2=5', $existsCatalog->id);
                }

                continue;
            }

            $this->parseCategory($category);
        }

        $this->info('Well done!');
    }

    /**
     * @param array $category
     * @throws \Exception
     */
    private function parseCategory(array $category): void
    {
        $this->saveCatalog($category);
    }

    /**
     * @param array $category
     * @throws \Exception
     */
    private function saveCatalog(array $category): void
    {
        $catalog = new Catalog();
        $catalog->parent_id = 46;
        $catalog->name = $category['name'];
        $catalog->alias = 'teplodar-' . str_slug($catalog->name);
        $catalog->title = $catalog->name . ' | Всё для бани';
        $catalog->description = $catalog->name . ', выгодные предложения для Вас. Звоните по номеру телефона +7 (978) 784-70-93';

        if($catalog->save()) {
            foreach ($category['child'] as $child) {
                $this->parseItems($child['link'], $catalog->id);
                $this->parseItems($child['link']. '?PAGEN_2=2', $catalog->id);
                $this->parseItems($child['link']. '?PAGEN_2=3', $catalog->id);
                $this->parseItems($child['link']. '?PAGEN_2=4', $catalog->id);
                $this->parseItems($child['link']. '?PAGEN_2=5', $catalog->id);
            }
        }
    }

    /**
     * @param $uri
     * @param $catalogId
     * @throws \Exception
     */
    private function parseItems($uri, $catalogId): void
    {
        $document = file_get_contents(self::BASE_URL . $uri);

        if ($document) {
            $crawler = new Crawler($document);

            $links = $crawler->filter('.good-box-table .good-item .good-img > a')->each(static function (Crawler $node) {
                return $node->attr('href');
            });

//            if (!count($links)) {
//                $links = [$uri];
//            }

            if (count($links)) {
                foreach ($links as $link) {
                    $document = file_get_contents(self::BASE_URL . $link);
                    $crawler = new Crawler($document);

                    $name = $crawler->filter('.good-box h1')->first()->text();

                    $name = trim($name);

                    $priceString = $crawler->filter('.good-box .price-block .price-block-left > span')->first();

                    $this->info(self::BASE_URL . $link);

                    $price = (int)str_replace(' ', '', $priceString->text());

                    $image = self::BASE_URL . $crawler->filter('.detail-img-slider .connected-carousels .carousel-stage li img')->first()->attr('src');

                    $text = $crawler->filter('#first-tab .special-details-box');
                    $text2 = $crawler->filter('#first-tab .technical-features-box');

                    if ($text->count()) {
                        $text = preg_replace ("!<a.*?href=\"?'?([^ \"'>]+)\"?'?.*?>(.*?)</a>!is", '$2',  $text->html());
                    } else {
                        $text = '';
                    }

                    if ($text2->count()) {
                        $text .= $text2->html();
                    }

                    $existsCatalogProduct = CatalogProduct::where('alias', str_slug($name))->where('catalog_id', $catalogId)->first();

                    if ($existsCatalogProduct) {
                        continue;
                    }

                    $catalogProduct = new CatalogProduct();
                    $catalogProduct->catalog_id = $catalogId;
                    $catalogProduct->name = $name;

                    $alias = 'teplodar-' . str_slug($name);

                    if (CatalogProduct::where('alias', $alias)->exists()) {
                        continue;
                    }

                    $catalogProduct->alias = $alias;

                    $catalogProduct->title = $catalogProduct->name . ' | Всё для бани';
                    $catalogProduct->description = $catalogProduct->name . ', выгодные предложения для Вас. Звоните по номеру телефона +7 (978) 784-70-93';
                    $catalogProduct->price = $price;
                    $catalogProduct->text = $text;

                    if ($catalogProduct->save() && $image) {
                        $imageNew = explode('/', $image);

                        $name = Str::random(40);

                        $ext = explode('.', end($imageNew));

                        $path = Storage::path('public/test_items') . '/' . $name . '.' . end($ext);

                        if(File::copy($image, $path)) {
                            $newImage = new Image();
                            $newImage->path = '/storage/images/' . $name . '.' . end($ext);
                            $newImage->imageable_type = CatalogProduct::class;
                            $newImage->imageable_id = $catalogProduct->id;
                            $newImage->alt = $catalogProduct->name;

                            if ($newImage->save()) {

                                $im = (new ImageManager())->make($path);

                                $imHeight = $im->height();
                                $imWidth = $im->width();

                                $im->text('fabrikabani-krym.ru', abs($imWidth/2), abs($imHeight/2), static function($font) {
                                    $font->file(public_path('fonts/Arial-Black.ttf'));
                                    $font->size(30);
                                    $font->color(array(255, 255, 255, 0.6));
                                    $font->align('center');
                                    $font->valign('middle');
                                    $font->angle(45);
                                })
                                    ->save(Storage::path('public/test_items') . '/' . $name . '.' . end($ext));
                            }
                        }
                    } else {
                        dd($catalogProduct);
                    }
                }
            }
        }
    }
}
