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

class CatalogDbSeeder extends Command
{
    private const BASE_URL = 'http://vse-dlia-bani.ru/%D0%BA%D0%B0%D1%82%D0%B0%D0%BB%D0%BE%D0%B3/';

    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'command:catalog';

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

        $categories = $crawler->filter('.cat_wrapper .cat_item a')->each(static function (Crawler $node) {

            $image = $node->filter('img')->first()->attr('src');

            return [
                'name' => $node->filter('h3')->first()->text(),
                'link' => $node->attr('href'),
                'image' => $image
            ];
        });

        foreach ($categories as $category) {

            $existsCatalog = Catalog::where('alias', str_slug($category['name']))->first();

            if ($existsCatalog) {

                $this->parseItems($category['link'], $existsCatalog->id);

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
        $catalog->name = $category['name'];
        $catalog->alias = str_slug($catalog->name);
        $catalog->title = $catalog->name . ' | Всё для бани';
        $catalog->description = $catalog->name . ', выгодные предложения для Вас. Звоните по номеру телефона +7 (978) 784-70-93';

        if ($catalog->save() && $category['image'] && ! strstr('data:image/jpeg;base64', $category['image'])) {

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
        }
    }

    /**
     * @param $uri
     * @param $catalogId
     * @throws \Exception
     */
    private function parseItems($uri, $catalogId): void
    {
        $document = file_get_contents('http://vse-dlia-bani.ru'.$uri);

        $crawler = new Crawler($document);

        $links = $crawler->filter('.taxonomy_content .taxonomy_item a')->each(static function (Crawler $node) {
            return $node->attr('href');
        });

        if ($links) {
            foreach ($links as $link) {
                $document = file_get_contents($link);
                $crawler = new Crawler($document);

                $name = $crawler->filter('.single_item > h1')->first()->text();
                $price = (int)$crawler->filter('.price_wrapper .price')->first()->text();
                $image = $crawler->filter('.thumbnails img')->first()->attr('src');

                $existsCatalogProduct = CatalogProduct::where('alias', str_slug($name))->first();

                $catalogProduct = new CatalogProduct();
                $catalogProduct->catalog_id = $catalogId;
                $catalogProduct->name = $name;

                if ($existsCatalogProduct) {
                    $catalogProduct->alias = str_slug($catalogProduct->name) .'-' . random_int(0,10);
                } else {
                    $catalogProduct->alias = str_slug($catalogProduct->name);
                }


                $catalogProduct->title = $catalogProduct->name . ' | Всё для бани';
                $catalogProduct->description = $catalogProduct->name . ', выгодные предложения для Вас. Звоните по номеру телефона +7 (978) 784-70-93';
                $catalogProduct->price = $price;

                if ($catalogProduct->save() && $image && ! strstr('data:image/jpeg;base64', $image)) {
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
