<?php

namespace Database\Seeders;

use Carbon\Carbon;
use App\Models\Brand;
use Illuminate\Support\Str;
use Illuminate\Database\Seeder;
use Faker\Factory as Faker;
use Illuminate\Support\Facades\File;
use Intervention\Image\Laravel\Facades\Image;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class BrandSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run()
    {
        $faker = Faker::create();
        $imagePath = public_path('seeders/brands');
        $files = File::files($imagePath); // Get all images in the folder
        $brands = ['Nike', 'Adidas', 'Gucci', 'Prada', 'Louis Vuitton', 'Zara', 'H&M', 'Versace', 'Balenciaga', 'Tommy Hilfiger'];

        foreach ($files as $file) {
            $fileName = $file->getFilename();
            $name = $faker->randomElement($brands);
            $slug = Str::slug($name);

            // Generate thumbnails and save them
            $generatedFileName = $this->GenerateBrandThumbnailsImage($file, $fileName);
            $existingSlug = Brand::where('slug', $slug)->first();

            if ($existingSlug) {
                continue; // Skip duplicate slug
            }
            // Create brand entry
            $brand = Brand::create([
                'name' =>  $name,
                'slug' => $slug,
                'image' => $generatedFileName,
            ]);
        }

        echo "Brands seeded successfully!";
    }

    private function GenerateBrandThumbnailsImage($image, $imageName)
    {
        $destinationPath = public_path('uploads/brands');
        if (!File::exists($destinationPath)) {
            File::makeDirectory($destinationPath, 0777, true, true);
        }

        $img = Image::read($image->getPathname());
        $img->cover(124, 124, 'top');
        $img->resize(124, 124, function ($constraint) {
            $constraint->aspectRatio();
        })
            ->save($destinationPath . '/' . $imageName);

        return $imageName;
    }
}
