<?php

namespace App\Console\Commands;

use App\Catalog;
use App\CatalogProduct;
use App\Image;
use File;
use Illuminate\Console\Command;
use Illuminate\Support\Str;
use Intervention\Image\ImageManager;
use Storage;
use Symfony\Component\DomCrawler\Crawler;

class CatalogSixDbSeeder extends Command
{

    private const BASE_URL = 'https://3d-sauna.ru';

    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'command:catalog-six';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Set to db catalog and items from source site url';

    private $linksItems = [];

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
//            'https://3d-sauna.ru/elektricheskiye-pechi',
//            'https://3d-sauna.ru/pulty-sistemy-upravleniya',
//            'https://3d-sauna.ru/dveri-dlya-bani-i-sauni',
//            'https://3d-sauna.ru/plitka-i-ugolok',
//            'https://3d-sauna.ru/dushevye-kabiny',
//            'https://3d-sauna.ru/gotovye-sauny',
//            'https://3d-sauna.ru/infrakrasnoe-oborudovanie',
//            'https://3d-sauna.ru/osveshenie-dlya-sauny-i-bany',
//            'https://3d-sauna.ru/aksessuary',
//            'https://3d-sauna.ru/zapchasti-dlja-elektropechey',
//            'https://3d-sauna.ru/pechi-v-oblitsovke-kamnem',
//            'https://3d-sauna.ru/drovjanye-pechi',
//            'https://3d-sauna.ru/gazovye-pechi-dlya-bani',
//            'https://3d-sauna.ru/gimalajskaja-sol',
            'https://3d-sauna.ru/aromatizatori'
        ];

        foreach ($links as $link) {
            $document = file_get_contents($link);
            $crawler = new Crawler($document);

            $hasSubCats = $crawler->filter('.catalog__categories-list a')->each(static function (Crawler $node) {
                return $node->attr('href');
            });

            $catName = $crawler->filter('.content h1')->first()->text();

            $this->saveCatalog($catName, $hasSubCats, $link);

            //break;
        }
    }

    private function saveCatalog($catName, $hasSubCats, $link): void
    {

        $alias = '3d-sauni-' . str_slug($catName);

        $existsSubCatalog = Catalog::where('alias', $alias)->exists();

        if ($existsSubCatalog) {
            while (Catalog::where('alias', $alias)->exists()) {
                $alias .= '-' . random_int(1, 1000);
            }
        }

        $catalog = new Catalog();
        $catalog->name = $catName;
        $catalog->alias = $alias;
        $catalog->title = $catalog->name . ' | Всё для бани';
        $catalog->description = $catalog->name . ', выгодные предложения для Вас. Звоните по номеру телефона +7 (978) 784-70-93';

        $result = $catalog->save();

        if($result && count($hasSubCats)) {
            foreach ($hasSubCats as $hasSubCatLink) {
                $document = file_get_contents(self::BASE_URL . $hasSubCatLink);
                $crawler = new Crawler($document);

                $catSubName = $crawler->filter('.content h1')->first()->text();

                $alias = '3d-sauni-' . str_slug($catSubName);

                $existsSubCatalog = Catalog::where('alias', $alias)->exists();

                if ($existsSubCatalog) {

                    $alias = $catalog->alias . $alias;

                    while (Catalog::where('alias', $alias)->exists()) {
                        $alias .= '-' . random_int(1, 1000);
                    }
                }

                $subCatalog = new Catalog();
                $subCatalog->parent_id = $catalog->id;
                $subCatalog->name = $catSubName;
                $subCatalog->alias = $alias;
                $subCatalog->title = $catalog->name . ' | Всё для бани';
                $subCatalog->description = $catalog->name . ', выгодные предложения для Вас. Звоните по номеру телефона +7 (978) 784-70-93';
                $subCatalog->save();

                $links = $crawler->filter('.products__list .product a.p-card__image')->each(static function (Crawler $node) {
                    return $node->attr('href');
                });

                foreach ($links as $l) {
                    $this->parseItem($l, $subCatalog->id);
                }

                $paginator = $crawler->filter('.category__pagination .pagination a');

                if (count($paginator) && ($last = (int) $paginator->last()->text())) {

                    for ($i = 2; $i <= $last; $i++) {

                        $document = file_get_contents(self::BASE_URL . $hasSubCatLink . '?page=' . $i);
                        $crawler = new Crawler($document);

                        $links = $crawler->filter('.products__list .product a.p-card__image')->each(static function (Crawler $node) {
                            return $node->attr('href');
                        });

                        foreach ($links as $l) {
                            $this->parseItem($l, $subCatalog->id);
                        }
                    }
                }

            }
        } elseif ($result) {

            $this->info('Not subcategories - ' . $link);

            $document = file_get_contents($link);
            $crawler = new Crawler($document);

            $links = $crawler->filter('.products__list .product a.p-card__image')->each(static function (Crawler $node) {
                return $node->attr('href');
            });

            foreach ($links as $l) {
                $this->parseItem($l, $catalog->id);
            }

            $paginator = $crawler->filter('.category__pagination .pagination a');

            if (count($paginator) && ($last = (int) $paginator->last()->text())) {

                for ($i = 2; $i <= $last; $i++) {

                    $document = file_get_contents($link . '?page=' . $i);
                    $crawler = new Crawler($document);

                    $links = $crawler->filter('.products__list .product a.p-card__image')->each(static function (Crawler $node) {
                        return $node->attr('href');
                    });

                    foreach ($links as $l) {
                        $this->parseItem($l, $catalog->id);
                    }
                }
            }
        }

    }

    /**
     * @param $link
     * @param $categoryId
     * @throws \Exception
     */
    private function parseItem($link, $categoryId): void
    {
        $document = file_get_contents(self::BASE_URL . $link);
        $crawler = new Crawler($document);

        $name = $crawler->filter('.product__head h1')->first()->text();

        $alias = str_slug($name);

        $existsCatalogProduct = CatalogProduct::where('alias', $alias)->exists();

        if ($existsCatalogProduct) {
            while (CatalogProduct::where('alias', $alias)->exists()) {
                $alias .= '-' . random_int(1, 1000);
            }
        }

        $inStockBlock = $crawler->filter('.product__stock');

        if (count($inStockBlock) && trim($inStockBlock->filter('span')->first()->text()) === 'в наличии') {

            $this->info(self::BASE_URL . $link);

            $price = (int) str_replace(' ', '', $crawler->filter('.price span')->first()->text());

            $text = $crawler->filter('.product__properties');
            $text2 = $crawler->filter('.product__bottom #product-description');

            if ($text->count()) {
                $text = preg_replace ("!<a.*?href=\"?'?([^ \"'>]+)\"?'?.*?>(.*?)</a>!is", '$2',  $text->html());
            } else {
                $text = '';
            }

            if ($text2->count()) {
                $text .= $text2->html();
            }

            $catalogProduct = new CatalogProduct();
            $catalogProduct->catalog_id = $categoryId;
            $catalogProduct->name = $name;

            $catalogProduct->text = $text;

            $catalogProduct->alias = $alias;

            $catalogProduct->title = $catalogProduct->name . ' | Всё для бани';
            $catalogProduct->description = $catalogProduct->name . ', выгодные предложения для Вас. Звоните по номеру телефона +7 (978) 784-70-93';
            $catalogProduct->price = $price;

            $image = $crawler->filter('.product__photos .product__photo img');

            if ($catalogProduct->save() && count($image) && ($image = self::BASE_URL . $image->first()->attr('src'))) {
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
                        })->save(Storage::path('public/test_items') . '/' . $name . '.' . end($ext));
                    }
                 }
            }
        }
    }
}
