<?php

namespace Database\Seeders;

use Carbon\Carbon;
use App\Models\Category;
use Illuminate\Support\Str;
use Illuminate\Database\Seeder;
use Faker\Factory as Faker;
use Illuminate\Support\Facades\File;
use Intervention\Image\Laravel\Facades\Image;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class CategorySeeder extends Seeder
{
    public function run()
    {
        $faker = Faker::create();
        $imagePath = public_path('seeders/categories');
        $files = File::files($imagePath); // Get all images in folder

        $categories = [
            'sl' => ['Majice', 'Hlače', 'Jakne', 'Čevlji', 'Dodatki', 'Puloverji', 'Obleke', 'Kratke hlače', 'Kape', 'Nogavice'],
            'en' => ['T-Shirts', 'Jeans', 'Jackets', 'Shoes', 'Accessories', 'Sweaters', 'Dresses', 'Shorts', 'Hats', 'Socks'],
            'it' => ['Magliette', 'Jeans', 'Giacche', 'Scarpe', 'Accessori', 'Maglioni', 'Vestiti', 'Pantaloncini', 'Cappelli', 'Calzini']
        ];

        foreach ($files as $index => $file) {

            $fileName = $file->getFilename();

            $nameEn = $categories['en'][$index % count($categories['en'])];
            $slug = Str::slug($nameEn);


            // Generate thumbnails and save them
            $generatedFileName = $this->GenerateCategoryThumbnailsImage($file, $fileName);

            $existingSlug = Category::where('slug', $slug)->first();

            if ($existingSlug) {
                continue; // Skip duplicate slug
            }
            // Prepare category data
            $categoryData = [
                'slug' => $slug,
                'image' => $generatedFileName,
            ];

            // Prepare translation data
            $translations = [];
            foreach (config('app.supported_locales') as $locale) {
                $name = $categories[$locale][$index % count($categories[$locale])];
                $translations[$locale] = [
                    'locale' => $locale,
                    'name' => $name
                ];
            }

            // Create category and attach translations
            $category = Category::create($categoryData);
            $category->translations()->createMany($translations);
        }


        echo "Categories seeded successfully!";
    }

    private function GenerateCategoryThumbnailsImage($image, $imageName)
    {
        $destinationPathThumbnail = public_path('uploads/categories/thumbnails');
        $destinationPath = public_path('uploads/categories');

        // Ensure directories exist
        File::ensureDirectoryExists($destinationPath);
        File::ensureDirectoryExists($destinationPathThumbnail);

        $img = Image::read($image->getPathname());
        $img->cover(700, 700, 'top');
        $img
            ->resize(700, 700, function ($constraint) {
                $constraint->aspectRatio();
            })
            ->save($destinationPath . '/' . $imageName);

        $img
            ->resize(124, 124, function ($constraint) {
                $constraint->aspectRatio();
            })
            ->save($destinationPathThumbnail . '/' . $imageName);
        return  $imageName;
    }
}
