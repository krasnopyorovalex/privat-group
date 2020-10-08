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

class CatalogThirdDbSeeder extends Command
{
    private const BASE_URL = "https://kurna-tut.ru/";

    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'command:catalog-third';

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
        $this->parseItems();

        $this->info('Well done!');
    }

    /**
     * @throws \Exception
     */
    private function parseItems(): void
    {
        $links = [
            "https://kurna-tut.ru/rakoviny/kruglaya/rakovina-mramornaya-rm01/",
            "https://kurna-tut.ru/rakoviny/ovalnaya/rakovina-mramornaya-rm02/",
        ];

        if ($links) {
            foreach ($links as $link) {
                $document = file_get_contents($link);
                $crawler = new Crawler($document);

                $name = $crawler->filter('.product-wr .product-name h1')->first()->text();
                $price = (int)$crawler->filter('.product-wr .product-price a span')->first()->text();
                $image = $crawler->filter('.product-wr .product-main-image img')->first()->attr('src');

                $existsCatalogProduct = CatalogProduct::where('alias', str_slug($name))->first();

                $catalogProduct = new CatalogProduct();
                $catalogProduct->catalog_id = 39;
                $catalogProduct->name = $name;

                if ($existsCatalogProduct) {
                    $catalogProduct->alias = str_slug($catalogProduct->name) .'-' . random_int(0,10);
                } else {
                    $catalogProduct->alias = str_slug($catalogProduct->name);
                }


                $catalogProduct->title = $catalogProduct->name . ' | Всё для бани';
                $catalogProduct->description = $catalogProduct->name . ', выгодные предложения для Вас. Звоните по номеру телефона +7 (978) 784-70-93';
                $catalogProduct->price = $price;

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
