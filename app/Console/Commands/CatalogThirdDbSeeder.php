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
            'https://kurna-tut.ru/kurny/ostrovnaya/kurna-mramornaya-km01/',
            'https://kurna-tut.ru/kurny/uglovaya/kurna-mramornaya-km02/',
            'https://kurna-tut.ru/kurny/uglovaya/kurna-mramornaya-km03/',
            'https://kurna-tut.ru/kurny/pristennaya/kurna-mramornaya-km04/',
            'https://kurna-tut.ru/kurny/ostrovnaya/kurna-mramornaya-km05/',
            'https://kurna-tut.ru/kurny/ostrovnaya/kurna-mramornaya-km06/',
            'https://kurna-tut.ru/kurny/pristennaya/kurna-mramornaya-km07/',
            'https://kurna-tut.ru/kurny/pristennaya/kurna-mramornaya-km08/',
            'https://kurna-tut.ru/kurny/ostrovnaya/kurna-mramornaya-km09/',
            'https://kurna-tut.ru/kurny/pristennaya/kurna-mramornaya-km10/',
            'https://kurna-tut.ru/kurny/pristennaya/kurna-mramornaya-km11/',
            'https://kurna-tut.ru/kurny/pristennaya/kurna-mramornaya-km12/',
            'https://kurna-tut.ru/kurny/pristennaya/kurna-mramornaya-km13/',
            'https://kurna-tut.ru/kurny/pristennaya/kurna-mramornaya-km14/',
            'https://kurna-tut.ru/kurny/pristennaya/kurna-mramornaya-km15/',
            'https://kurna-tut.ru/kurny/pristennaya/kurna-mramornaya-km16/',
            'https://kurna-tut.ru/kurny/pristennaya/kurna-mramornaya-km17/',
            'https://kurna-tut.ru/kurny/pristennaya/kurna-mramornaya-km18/',
            'https://kurna-tut.ru/kurny/ostrovnaya/kurna-mramornaya-km19/',
            'https://kurna-tut.ru/kurny/ostrovnaya/kurna-mramornaya-km20/',
            'https://kurna-tut.ru/kurny/pristennaya/kurna-mramornaya-km21/',
            'https://kurna-tut.ru/kurny/ostrovnaya/kurna-mramornaya-km22/',
            'https://kurna-tut.ru/kurny/ostrovnaya/kurna-mramornaya-km23/',
            'https://kurna-tut.ru/kurny/ostrovnaya/kurna-mramornaya-km24/',
            'https://kurna-tut.ru/kurny/pristennaya/kurna-mramornaya-km25/',
            'https://kurna-tut.ru/kurny/pristennaya/kurna-mramornaya-km26/',
            'https://kurna-tut.ru/kurny/pristennaya/kurna-mramornaya-km27/',
            'https://kurna-tut.ru/kurny/pristennaya/kurna-mramornaya-km28/',
            'https://kurna-tut.ru/kurny/pristennaya/kurna-mramornaya-km29/',
            'https://kurna-tut.ru/kurny/pristennaya/kurna-mramornaya-km30/',
            'https://kurna-tut.ru/kurny/ostrovnaya/kurna-mramornaya-km31/',
            'https://kurna-tut.ru/kurny/pristennaya/kurna-mramornaya-km32/',
            'https://kurna-tut.ru/kurny/pristennaya/kurna-mramornaya-km33/',
            'https://kurna-tut.ru/kurny/ostrovnaya/kurna-mramornaya-km34/',
            'https://kurna-tut.ru/kurny/pristennaya/kurna-mramornaya-km35/',
            'https://kurna-tut.ru/kurny/pristennaya/kurna-mramornaya-km36/',
            'https://kurna-tut.ru/kurny/pristennaya/kurna-mramornaya-km37/',
            'https://kurna-tut.ru/kurny/pristennaya/kurna-mramornaya-km38/',
            'https://kurna-tut.ru/kurny/pristennaya/kurna-mramornaya-km39/',
            'https://kurna-tut.ru/kurny/pristennaya/kurna-mramornaya-km40/',
            'https://kurna-tut.ru/kurny/pristennaya/kurna-mramornaya-km41/',
            'https://kurna-tut.ru/kurny/pristennaya/kurna-mramornaya-km42/',
            'https://kurna-tut.ru/kurny/pristennaya/kurna-mramornaya-km43/',
            'https://kurna-tut.ru/kurny/pristennaya/kurna-mramornaya-km44/',
            'https://kurna-tut.ru/kurny/pristennaya/kurna-mramornaya-km45/',
            'https://kurna-tut.ru/kurny/pristennaya/kurna-mramornaya-km46/',
            'https://kurna-tut.ru/kurny/pristennaya/kurna-mramornaya-km47/',
            'https://kurna-tut.ru/kurny/pristennaya/kurna-mramornaya-km48/',
            'https://kurna-tut.ru/kurny/pristennaya/kurna-mramornaya-km49/',
            'https://kurna-tut.ru/kurny/pristennaya/kurna-mramornaya-km50/',
            'https://kurna-tut.ru/kurny/pristennaya/kurna-mramornaya-km51/',
            'https://kurna-tut.ru/kurny/pristennaya/kurna-mramornaya-km52/',
            'https://kurna-tut.ru/kurny/pristennaya/kurna-mramornaya-km53/',
            'https://kurna-tut.ru/kurny/pristennaya/kurna-mramornaya-km54/',
            'https://kurna-tut.ru/kurny/pristennaya/kurna-mramornaya-km55/',
            'https://kurna-tut.ru/kurny/pristennaya/kurna-mramornaya-km56/',
            'https://kurna-tut.ru/kurny/pristennaya/kurna-mramornaya-km57/',
            'https://kurna-tut.ru/kurny/pristennaya/kurna-mramornaya-km58/',
            'https://kurna-tut.ru/kurny/pristennaya/kurna-mramornaya-km59/',
            'https://kurna-tut.ru/kurny/ostrovnaya/kurna-mramornaya-km60/',
            'https://kurna-tut.ru/kurny/pristennaya/kurna-mramornaya-km61/',
            'https://kurna-tut.ru/kurny/pristennaya/kurna-mramornaya-km62/',
            'https://kurna-tut.ru/kurny/pristennaya/kurna-mramornaya-km63/',
            'https://kurna-tut.ru/kurny/pristennaya/kurna-mramornaya-km64/',
            'https://kurna-tut.ru/kurny/pristennaya/kurna-mramornaya-km65/',
            'https://kurna-tut.ru/kurny/pristennaya/kurna-mramornaya-km66/',
            'https://kurna-tut.ru/kurny/pristennaya/kurna-mramornaya-km67/',
            'https://kurna-tut.ru/kurny/pristennaya/kurna-mramornaya-km68/',
            'https://kurna-tut.ru/kurny/pristennaya/kurna-mramornaya-km69/',
            'https://kurna-tut.ru/kurny/pristennaya/kurna-mramornaya-km70/',
            'https://kurna-tut.ru/kurny/pristennaya/kurna-mramornaya-km71/',
            'https://kurna-tut.ru/kurny/pristennaya/kurna-mramornaya-km72/',
            'https://kurna-tut.ru/kurny/pristennaya/kurna-mramornaya-km73/',
            'https://kurna-tut.ru/kurny/pristennaya/kurna-mramornaya-km74/',
            'https://kurna-tut.ru/kurny/pristennaya/kurna-mramornaya-km75/',
            'https://kurna-tut.ru/kurny/pristennaya/kurna-mramornaya-km76/',
            'https://kurna-tut.ru/kurny/pristennaya/kurna-mramornaya-km77/',
            'https://kurna-tut.ru/kurny/pristennaya/km78/',
            'https://kurna-tut.ru/kurny/pristennaya/kurna-km79/',
            'https://kurna-tut.ru/kurny/pristennaya/kurna-km80/',
            'https://kurna-tut.ru/kurny/pristennaya/km81/',
            'https://kurna-tut.ru/kurny/pristennaya/kurna-km82/',
            'https://kurna-tut.ru/kurny/pristennaya/kurna-km83/',
            'https://kurna-tut.ru/kurny/uglovaya/kurna-km84/',
            'https://kurna-tut.ru/kurny/uglovaya/kurna-km85/',
            'https://kurna-tut.ru/kurny/uglovaya/kurna-km86/',
            'https://kurna-tut.ru/kurny/uglovaya/kurna-km87/',
            'https://kurna-tut.ru/kurny/uglovaya/kurna-mramornaya-km88/',
            'https://kurna-tut.ru/kurny/uglovaya/%d0%ba%d1%83%d1%80%d0%bd%d0%b0-%d0%bc%d1%80%d0%b0%d0%bc%d0%be%d1%80%d0%bd%d0%b0%d1%8f-%d0%ba%d0%bc89/'
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
                $catalogProduct->catalog_id = 29;
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
