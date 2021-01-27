<?php

namespace App\Console\Commands;

use App\CatalogProductImage;
use App\Image;
use Illuminate\Console\Command;
use Intervention\Image\ImageManager;
use Storage;

class OptimizeImages extends Command
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
                ->fit(360, 360)
                ->save(public_path('storage/catalog_products/' . $file->catalog_product_id .'/' . $file->basename . '_thumb.' . $file->ext));
        }

        $images = Image::where('imageable_type', 'App\CatalogProduct')->get();

        foreach ($images as $image) {
            $extension = pathinfo($image['path'], PATHINFO_EXTENSION);

            $path = str_replace('//storage', '/public', Storage::path($image['path']));

            (new ImageManager())
                ->make($path)
                ->fit(360, 360)
                ->save(str_replace('.'.$extension, '_thumb.' . $extension, $path));
        }

        $this->info('Well done!');
    }
}
