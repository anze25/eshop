<?php

namespace App\Http\Controllers\Admin;

use Carbon\Carbon;
use App\Models\Brand;
use App\Models\Product;
use App\Models\Category;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\File;
use Intervention\Image\Laravel\Facades\Image;

class AdminProductController extends Controller
{
    /** PRODUCTS */
    public function products()
    {
        $products = Product::orderBy('created_at', 'DESC')->paginate(10);
        return view('admin.products', compact('products'));
    }

    public function product_add()
    {
        $locale = app()->getLocale(); // Get current language setting


        $categories = Category::with(['translations' => function ($query) use ($locale) {
            $query->where('locale', $locale);
        }])->get();


        $brands = Brand::select('id', 'name')->orderBy('name')->get();

        return view('admin.product-add', compact('categories', 'brands', 'locale'));
    }

    public function product_store(Request $request)
    {
        $rules = [
            'image' => 'required|mimes:png,jpg,jpeg|max:2048',
            'slug' => 'required|unique:products,slug',
            'regular_price' => 'required',
            'SKU' => 'required',
            'featured' => 'required',
            'quantity' => 'required',
            'category_id' => 'required',
            'brand_id' => 'required',
        ];
        // Add dynamic validation rules for each locale
        foreach (config('app.supported_locales') as $locale) {
            $rules["{$locale}.name"] = ['required', 'max:200', "unique:product_translations,name,NULL,id,locale,{$locale}"];
            $rules["{$locale}.short_description"] = ['required', 'max:100'];
            $rules["{$locale}.description"] = ['required', 'max:1000'];
        }

        $validatedData = $request->validate($rules);


        $current_timestamp = Carbon::now()->timestamp;

        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $imageName = $current_timestamp . '.' . $image->extension();
            $this->GenerateProductThumbnailsImage($image, $imageName);
        }
        $gallery_arr = array();
        $gallery_images = "";
        $counter = 1;
        if ($request->hasFile('images')) {
            $allowedfileExtension = ['jpg', 'png', 'jpeg'];
            $files = $request->file('images');
            foreach ($files as $file) {
                $gextension = $file->getClientOriginalExtension();
                $check = in_array($gextension, $allowedfileExtension);
                if ($check) {
                    $gfilename = $current_timestamp . "-" . $counter . "." . $gextension;
                    $this->GenerateProductThumbnailsImage($file, $gfilename);
                    array_push($gallery_arr, $gfilename);


                    $counter = $counter + 1;
                }
            }
            $gallery_images = implode(',', $gallery_arr);
        }

        // Prepare base news data
        $productData = [

            'image' => $imageName,
            'images' => $gallery_images,
            'slug' => $request->slug,
            'regular_price' => $request->regular_price,
            'sale_price' => $request->sale_price,
            'SKU' => $request->SKU,
            'featured' => $request->featured,
            'quantity' => $request->quantity,
            'category_id' => $request->category_id,
            'brand_id' => $request->brand_id,

        ];

        // Prepare translation data
        $translations = [];
        foreach (config('app.supported_locales') as $locale) {
            $translations[$locale] = [
                'locale' => $locale,
                'name' => $request->input("{$locale}.name"),
                'short_description' => $request->input("{$locale}.short_description"),
                'description' => $request->input("{$locale}.description"),
            ];
        }


        $products = Product::create($productData);
        $products->translations()->createMany($translations);
        return redirect()->route('admin.products')->with([
            'message' => __('Created successfully!'),
            'alert-type' => 'success'
        ]);
    }

    public function product_edit($id)
    {
        $locale = app()->getLocale();
        $product = Product::with('translations')->findOrFail($id);
        $categories = Category::with(['translations' => function ($query) use ($locale) {
            $query->where('locale', $locale);
        }])->get();


        $brands = Brand::select('id', 'name')->orderBy('name')->get();
        return view('admin.product-edit', compact('product', 'categories', 'brands'));
    }

    public function product_update(Request $request)
    {
        $rules = [
            'image' => 'mimes:png,jpg,jpeg|max:2048',
            'slug' => Rule::unique('products', 'slug')->ignore($request->id),
            'regular_price' => 'required',
            'SKU' => 'required',
            'featured' => 'required',
            'quantity' => 'required',
            'category_id' => 'required',
            'brand_id' => 'required',
        ];
        // Add dynamic validation rules for each locale
        foreach (config('app.supported_locales') as $locale) {
            $rules["{$locale}.name"] = [
                'required',
                'max:200',
                Rule::unique('product_translations', 'name')
                    ->where('locale', $locale)
                    ->ignore($request->id, 'product_id') // Ignores the name of the current product
            ];
            $rules["{$locale}.short_description"] = ['required', 'max:100'];
            $rules["{$locale}.description"] = ['required', 'max:1000'];

            $validatedData = $request->validate($rules);
            $current_timestamp = Carbon::now()->timestamp;


            $product = Product::findOrFail($request->id);
            $imageName = $product->image;
            $gallery_images = $product->images;

            if ($request->hasFile('image')) {
                if (File::exists(public_path('uploads/products') . '/' . $product->image)) {
                    // Delete previous image
                    File::delete(public_path('uploads/products') . '/' . $product->image);
                }
                if (File::exists(public_path('uploads/products/thumbnails') . '/' . $product->image)) {
                    // Delete previous image
                    File::delete(public_path('uploads/products/thumbnails') . '/' . $product->image);
                }

                $image = $request->file('image');
                $imageName = $current_timestamp . '.' . $image->extension();
                $this->GenerateProductThumbnailsImage($image, $imageName);
            }
            $gallery_arr = array();

            $counter = 1;
            if ($request->hasFile('images')) {

                foreach (explode(',', $product->images) as $ofile) {
                    if (File::exists(public_path('uploads/products') . '/' . $ofile)) {
                        // Delete previous image
                        File::delete(public_path('uploads/products') . '/' . $ofile);
                    }
                    if (File::exists(public_path('uploads/products/thumbnails') . '/' . $ofile)) {
                        // Delete previous image
                        File::delete(public_path('uploads/products/thumbnails') . '/' . $ofile);
                    }
                }
                $allowedfileExtension = ['jpg', 'png', 'jpeg'];
                $files = $request->file('images');
                foreach ($files as $file) {
                    $gextension = $file->getClientOriginalExtension();
                    $check = in_array($gextension, $allowedfileExtension);
                    if ($check) {
                        $gfilename = $current_timestamp . "-" . $counter . "." . $gextension;
                        $this->GenerateProductThumbnailsImage($file, $gfilename);
                        array_push($gallery_arr, $gfilename);


                        $counter = $counter + 1;
                    }
                }
                $gallery_images = implode(',', $gallery_arr);
                $product->images = $gallery_images;
            }

            // Prepare base news data
            $productData = [

                'image' => $imageName,
                'images' => $gallery_images,
                'slug' => $request->slug,
                'regular_price' => $request->regular_price,
                'sale_price' => $request->sale_price,
                'SKU' => $request->SKU,
                'featured' => $request->featured,
                'quantity' => $request->quantity,
                'category_id' => $request->category_id,
                'brand_id' => $request->brand_id,

            ];

            // Prepare translation data
            $translations = [];
            foreach (config('app.supported_locales') as $locale) {
                $product->translations()->updateOrCreate(
                    ['locale' => $locale],
                    [
                        'name' => $request->input("{$locale}.name"),
                        'short_description' => $request->input("{$locale}.short_description"),
                        'description' => $request->input("{$locale}.description"),
                    ]
                );
            }
            $product->update($productData);

            return redirect()->route('admin.products')->with([
                'message' => __('Updated successfully!'),
                'alert-type' => 'info'
            ]);
        }
    }

    public function product_delete($id)
    {
        $product = Product::findOrFail($id);
        if (File::exists(public_path('uploads/products') . '/' . $product->image)) {
            // Delete previous image
            File::delete(public_path('uploads/products') . '/' . $product->image);
        }
        if (File::exists(public_path('uploads/products/thumbnails') . '/' . $product->image)) {
            // Delete previous image
            File::delete(public_path('uploads/products/thumbnails') . '/' . $product->image);
        }
        $product->delete();
        return redirect()->route('admin.products')->with([
            'message' => __('Deleted successfully!'),
            'alert-type' => 'info'
        ]);
    }

    public function GenerateProductThumbnailsImage($image, $imageName)
    {
        $destinationPathThumbnail = public_path('uploads/products/thumbnails');
        if (!File::exists($destinationPathThumbnail)) {
            File::makeDirectory($destinationPathThumbnail, 0777, true, true);
        }
        $destinationPath = public_path('uploads/products');
        if (!File::exists($destinationPath)) {
            File::makeDirectory($destinationPath, 0777, true, true);
        }
        $img = Image::read($image->path());
        $img->cover(540, 689, 'top');
        $img
            ->resize(540, 689, function ($constraint) {
                $constraint->aspectRatio();
            })
            ->save($destinationPath . '/' . $imageName);

        $img
            ->resize(104, 104, function ($constraint) {
                $constraint->aspectRatio();
            })
            ->save($destinationPathThumbnail . '/' . $imageName);
        return;
    }
}
