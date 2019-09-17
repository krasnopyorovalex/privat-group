<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Intervention\Image\ImageManager;
use Storage;

class InsertWatermark extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'command:insert-watermark';

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

        $files = Storage::files('public/watermark');

        foreach ($files as $file) {
            $im = (new ImageManager())->make(Storage::path($file));

            $imHeight = $im->height();
            $imWidth = $im->width();

            $im->text('fabrikabani-krym.ru', abs($imWidth/2), abs($imHeight/2), static function($font) {
                $font->file(public_path('fonts/Arial-Black.ttf'));
                $font->size(24);
                $font->color(array(255, 255, 255, 0.6));
                $font->align('center');
                $font->valign('middle');
                $font->angle(45);
            })->save(Storage::path($file));
        }

        $this->info('Well done!');
    }
}
