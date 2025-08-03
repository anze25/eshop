<?php

namespace Database\Seeders;

use App\Models\Slide;
use Faker\Factory as Faker;
use Illuminate\Support\Str;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\File;


use Intervention\Image\Laravel\Facades\Image;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class SlideSeeder extends Seeder
{
    public function run()
    {
        $faker = Faker::create();
        $imagePath = public_path('seeders/slides');
        $files = File::files($imagePath); // Get all images in folder

        // Example slide content data in each language
        $slides = [
            'en' => [
                [
                    'title' => 'End of Season Sale',
                    'subtitle' => 'Huge discounts on all collections',
                    'tagline' => 'Refresh your wardrobe today'
                ],
                [
                    'title' => 'New Arrivals',
                    'subtitle' => 'Latest trends for Summer 2025',
                    'tagline' => 'Look ahead, dress ahead'
                ],
                [
                    'title' => 'Free Shipping Weekend',
                    'subtitle' => 'No minimum spend required',
                    'tagline' => 'Just shop and enjoy the ride'
                ],
            ],
            'sl' => [
                [
                    'title' => 'Konec sezonske razprodaje',
                    'subtitle' => 'Veliki popusti na vse kolekcije',
                    'tagline' => 'Osveži svojo garderobo še danes'
                ],
                [
                    'title' => 'Novi prihodi',
                    'subtitle' => 'Zadnji modni trendi poletja 2025',
                    'tagline' => 'Poglej v prihodnost, obleci prihodnost'
                ],
                [
                    'title' => 'Vikend brez stroškov poštnine',
                    'subtitle' => 'Brez minimalne vrednosti nakupa',
                    'tagline' => 'Nakupuj in uživaj brez skrbi'
                ],
            ],
            'it' => [
                [
                    'title' => 'Saldi di fine stagione',
                    'subtitle' => 'Sconti enormi su tutte le collezioni',
                    'tagline' => 'Rinnova il tuo stile oggi stesso'
                ],
                [
                    'title' => 'Nuovi arrivi',
                    'subtitle' => 'Tendenze estive 2025',
                    'tagline' => 'Guarda avanti, vestiti avanti'
                ],
                [
                    'title' => 'Weekend di spedizione gratuita',
                    'subtitle' => 'Senza spesa minima',
                    'tagline' => 'Acquista ora, spediamo noi'
                ],
            ],
        ];


        foreach ($files as $index => $file) {
            $fileName = $file->getFilename();

            $generatedFileName = $this->GenerateSlideThumbnailsImage($file, $fileName);


            // Keep slug consistent across locales (based on English title)
            $titleEn = $slides['en'][$index % count($slides['en'])]['title'];
            $slug = Str::slug($titleEn);

            if (Slide::where('slug', $slug)->exists()) {
                continue; // Skip duplicates
            }

            $slideData = [
                'slug' => $slug,
                'link' => $faker->randomElement(
                    [
                        'https://fit.ly/xo1',
                        'https://drss.io/q3',
                        'https://styx.co/aa',
                        'http://fabz.io/t2',
                        'https://swg.to/u9',
                        'https://vlve.co/kt',
                        'http://modr.cc/w4',
                        'https://thr3e.io/yq'
                    ]
                ),
                'status' => 1,
                'image' => $fileName,
            ];

            $translations = [];
            foreach (config('app.supported_locales') as $locale) {
                $slideText = $slides[$locale][$index % count($slides[$locale])];
                $translations[$locale] = array_merge($slideText, ['locale' => $locale]);
            }

            $slide = Slide::create($slideData);
            $slide->translations()->createMany($translations);
        }

        echo "Slides seeded successfully!";
    }

    public function GenerateSlideThumbnailsImage($image, $imageName)
    {
        $destinationPath = public_path('uploads/slides');
        if (!File::exists($destinationPath)) {
            File::makeDirectory($destinationPath, 0777, true, true);
        }
        $img = Image::read($image->getPathname());
        $img->cover(400, 690, 'top');
        $img->resize(400, 690, function ($constraint) {
            $constraint->aspectRatio();
        })
            ->save($destinationPath . '/' . $imageName);
        return;
    }
}
