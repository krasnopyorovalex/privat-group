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

class CatalogFourDbSeeder extends Command
{
    private const BASE_URL = 'https://koster.pro';

    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'command:catalog-four';

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
        $document = file_get_contents(self::BASE_URL);

        $crawler = new Crawler($document);

        $categories = $crawler->filter('.menu-catalog > .menu-catalog__item')->each(static function (Crawler $node) {

            $link = $node->filter('a')->first();

            $child = $node->filter('.menu_sub_catalog__list')->first()->filter('li')->each(static function (Crawler $node) {

                $link = $node->filter('a')->first();

                return [
                    'name' => $link->text(),
                    'link' => $link->attr('href'),
                ];
            });

            return [
                'name' => $link->text(),
                'link' => $link->attr('href'),
                'child' => $child
            ];
        });

        foreach ($categories as $category) {

            $existsCatalog = Catalog::where('alias', str_slug($category['name']))->first();

            if ($existsCatalog) {

                if (count($category['child'])) {
                    foreach ($category['child'] as $child) {
                        $this->parseItems($child['link'], $existsCatalog->id);
                        $this->parseItems($child['link']. '?PAGEN_1=2', $existsCatalog->id);
                    }
                } else {
                    $this->parseItems($category['link'], $existsCatalog->id);
                    $this->parseItems($category['link']. '?PAGEN_1=2', $existsCatalog->id);
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
        $catalog->parent_id = 40;
        $catalog->name = $category['name'];
        $catalog->alias = str_slug($catalog->name);
        $catalog->title = $catalog->name . ' | Всё для бани';
        $catalog->description = $catalog->name . ', выгодные предложения для Вас. Звоните по номеру телефона +7 (978) 784-70-93';

        if($catalog->save()) {
            if (count($category['child'])) {
                foreach ($category['child'] as $child) {
                    $this->parseItems($child['link'], $catalog->id);
                    $this->parseItems($child['link']. '?PAGEN_1=2', $catalog->id);
                }
            } else {
                $this->parseItems($category['link'], $catalog->id);
                $this->parseItems($category['link']. '?PAGEN_1=2', $catalog->id);
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

        $crawler = new Crawler($document);

        $links = $crawler->filter('.catalog-items .catalog-item-list > a')->each(static function (Crawler $node) {
            return $node->attr('href');
        });

        if (count($links)) {
            foreach ($links as $link) {
                $document = file_get_contents(self::BASE_URL . $link);
                $crawler = new Crawler($document);

                $name = $crawler->filter('h1.header_1')->first()->text();

                $priceString = $crawler->filter('.catalog-item__price span')->first();

//                if ( !$priceString->count()) {
//                    $priceString = $crawler->filter('.prices_block .price .values_wrapper')->first();
//                }

                $this->info(self::BASE_URL . $link);

                $price = (int)str_replace(' ', '', $priceString->text());

                $imageWithHash = $crawler->filter('.kit-slider .kit-slider__link img')->first();

//                if ( !$image->count()) {
//                    $image = $crawler->filter('.item_slider .offers_img > a')->first();
//                }

                $imageWithHash  = self::BASE_URL . $imageWithHash->attr('src');

                [$image, $ex] = explode('?', $imageWithHash);

                $text = $crawler->filter('.catalog-item-properties');

                if ($text->count()) {
                    $text = $text->html();
                } else {
                    $text = '';
                }

                $existsCatalogProduct = CatalogProduct::where('alias', str_slug($name))->where('catalog_id', $catalogId)->first();

                if ($existsCatalogProduct) {
                    continue;
                }

                $catalogProduct = new CatalogProduct();
                $catalogProduct->catalog_id = $catalogId;
                $catalogProduct->name = $name;

                if (CatalogProduct::where('alias', str_slug($name))->exists()) {
                    $catalogProduct->alias = str_slug($catalogProduct->name) .'-' . random_int(0,10);
                } else {
                    $catalogProduct->alias = str_slug($catalogProduct->name);
                }

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
                                    $font->size(24);
                                    $font->color(array(255, 255, 255, 0.6));
                                    $font->align('center');
                                    $font->valign('middle');
                                    $font->angle(45);
                                })
                                ->save(Storage::path('public/test_items') . '/' . $name . '.' . end($ext));
                        }
                    }
                }
            }
        }
    }
}
