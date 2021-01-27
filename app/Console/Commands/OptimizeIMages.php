<?php

namespace App\Console\Commands;

use App\CatalogProductImage;
use Illuminate\Console\Command;
use Intervention\Image\ImageManager;
use Storage;

class OptimizeIMages extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'command:optimize-images';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Optimize images for current items';

    /**
     * @throws \Exception
     */
    public function handle()
    {

        $files = CatalogProductImage::all();

        foreach ($files as $file) {
            $image = Storage::path('public/catalog_products/' . $file->catalog_product_id . '/' . $file->basename.'.'.$file->ext);

            (new ImageManager())
                ->make($image)
                ->resize(360, 360)
                ->save(public_path('storage/catalog_products/' . $file->catalog_product_id .'/' . $file->basename . '_thumb.' . $file->ext));
        }

        $this->info('Well done!');
    }
}
