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

class CatalogSecondDbSeeder extends Command
{
    private const BASE_URL = 'https://grilld.ru/catalog/';

    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'command:catalog-second';

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

        $categories = $crawler->filter('.catalog_section_list .section_item_inner')->each(static function (Crawler $node) {

            $image = $node->filter('.image img')->first()->attr('src');

            $link = $node->filter('.section_info .dark_link')->first();

            return [
                'name' => $link->text(),
                'link' => $link->attr('href'),
                'image' => 'https://grilld.ru/'.$image
            ];
        });

        foreach ($categories as $category) {

            $existsCatalog = Catalog::where('alias', str_slug($category['name']))->first();

            if ($existsCatalog) {

                $this->parseItems($category['link'], $existsCatalog->id);
                $this->parseItems($category['link']. '?PAGEN_1=2', $existsCatalog->id);

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
        $catalog->parent_id = 21;
        $catalog->name = $category['name'];
        $catalog->alias = str_slug($catalog->name);
        $catalog->title = $catalog->name . ' | Всё для бани';
        $catalog->description = $catalog->name . ', выгодные предложения для Вас. Звоните по номеру телефона +7 (978) 784-70-93';

        if ($catalog->save() && $category['image']) {

            $image = explode('/', $category['image']);

            $name = Str::random(40);

            $ext = explode('.', end($image));

            $path = Storage::path('public/test') . '/' . $name . '.' . end($ext);

            if(File::copy($category['image'], $path)) {
                $newImage = new Image();
                $newImage->path = '/storage/images/' . $name . '.' . end($ext);
                $newImage->imageable_type = Catalog::class;
                $newImage->imageable_id = $catalog->id;
                $newImage->alt = $catalog->name;
                $newImage->save();
            }

            $this->parseItems($category['link'], $catalog->id);
            $this->parseItems($category['link']. '?PAGEN_1=2', $catalog->id);
        }
    }

    /**
     * @param $uri
     * @param $catalogId
     * @throws \Exception
     */
    private function parseItems($uri, $catalogId): void
    {
        $document = file_get_contents('https://grilld.ru'.$uri);

        $crawler = new Crawler($document);

        $links = $crawler->filter('.catalog_block.items.block_list a.thumb')->each(static function (Crawler $node) {
            return $node->attr('href');
        });

        if (count($links)) {
            foreach ($links as $link) {
                $document = file_get_contents('https://grilld.ru'.$link);
                $crawler = new Crawler($document);

                $name = $crawler->filter('#pagetitle')->first()->text();

                $priceString = $crawler->filter('.prices_block .price_value')->first();

                if ( !$priceString->count()) {
                    $priceString = $crawler->filter('.prices_block .price .values_wrapper')->first();
                }

                $this->info('https://grilld.ru'.$link);

                $price = (int)str_replace(' ', '', $priceString->text());

                $image = $crawler->filter('#photo-0 a')->first();

                if ( !$image->count()) {
                    $image = $crawler->filter('.item_slider .offers_img > a')->first();
                }

                $image  = 'https://grilld.ru/'.$image->attr('href');

                $text = $crawler->filter('.tabs_section .detail_text');

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
                        $newImage->save();
                    }
                }
            }
        }
    }
}
