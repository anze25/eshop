<?php

namespace App\Http\Controllers\Admin;

use Carbon\Carbon;
use App\Models\Category;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\File;
use Intervention\Image\Laravel\Facades\Image;

class AdminCategoryController extends Controller
{
    /** CATEGORIES */
    public function categories()
    {
        $categories = Category::orderBy('id', 'DESC')->paginate(10);
        return view('admin.categories', compact('categories'));
    }

    public function category_add()
    {
        return view('admin.category-add');
    }

    public function category_store(Request $request)
    {

        $rules = [
            'image' => 'mimes:png,jpg,jpeg|max:2048',
            'slug' => 'required|unique:categories,slug,'
        ];
        // Add dynamic validation rules for each locale
        foreach (config('app.supported_locales') as $locale) {
            $rules["{$locale}.name"] = ['required', 'max:200', "unique:category_translations,name,NULL,id,locale,{$locale}"];
        }

        $validatedData = $request->validate($rules);
        $image = $request->file('image');
        $file_extention = $image->extension();

        $file_name = Carbon::now()->timestamp . '.' . $file_extention;
        $this->GenerateCategoryThumbnailsImage($image, $file_name);


        // Prepare base news data
        $categoryData = [
            'slug' => $request->slug,
            'image' => $file_name,
        ];

        // Prepare translation data
        $translations = [];
        foreach (config('app.supported_locales') as $locale) {
            $translations[$locale] = [
                'locale' => $locale,
                'name' => $request->input("{$locale}.name"),
            ];
        }

        // Create category entry with translations
        $category = Category::create($categoryData);
        $category->translations()->createMany($translations);


        return redirect()->route('admin.categories')->with([
            'message' => __('Created successfully!'),
            'alert-type' => 'success'
        ]);
    }

    public function category_edit($id)
    {
        $category = Category::findOrFail($id);
        return view('admin.category-edit', compact('category'));
    }

    public function category_update(Request $request)
    {
        $rules = [
            'image' => 'mimes:png,jpg,jpeg|max:2048',
            'slug' => ['required', Rule::unique('categories', 'slug')->ignore($request->id)],
        ];

        // Add dynamic validation rules for each locale
        foreach (config('app.supported_locales') as $locale) {
            $rules["{$locale}.name"] = ['required', 'max:200', Rule::unique('category_translations', 'name')->ignore($request->id, 'category_id')];
        }

        $validatedData = $request->validate($rules);

        $category = Category::find($request->id); // hidden input in edit.blade

        $categoryData = [
            'slug' => $request->slug,

        ];
        // Prepare translation data
        $translations = [];
        foreach (config('app.supported_locales') as $locale) {
            $translations[$locale] = [
                'locale' => $locale,
                'name' => $request->input("{$locale}.name"),
            ];
        }


        if ($request->hasFile('image')) {
            if (File::exists(public_path('uploads/categories') . '/' . $category->image)) {
                File::delete(public_path('uploads/categories') . '/' . $category->image);
            }
            $image = $request->file('image');
            $file_extention = $request->file('image')->extension();
            $file_name = Carbon::now()->timestamp . '.' . $file_extention;
            $this->GenerateCategoryThumbnailsImage($image, $file_name);
            $category->image = $file_name;
        }

        $category->save();
        // Update translations
        foreach (config('app.supported_locales') as $locale) {
            $category->translations()->updateOrCreate(
                ['locale' => $locale, 'category_id' => $category->id],
                ['name' => $request->input("{$locale}.name")]
            );
        }
        return redirect()->route('admin.categories')->with([
            'message' => __('Updated successfully!'),
            'alert-type' => 'info'
        ]);
    }

    public function category_delete($id)
    {
        $category = Category::findOrFail($id);
        $category->translations()->delete();

        if (File::exists(public_path('uploads/categories') . '/' . $category->image)) {
            File::delete(public_path('uploads/categories') . '/' . $category->image);
        }
        $category->delete();
        return redirect()->route('admin.categories')->with([
            'message' => __('Deleted successfully!'),
            'alert-type' => 'info'
        ]);
    }

    public function GenerateCategoryThumbnailsImage($image, $imageName)
    {
        $destinationPathThumbnail = public_path('uploads/categories/thumbnails');
        if (!File::exists($destinationPathThumbnail)) {
            File::makeDirectory($destinationPathThumbnail, 0777, true, true);
        }
        $destinationPath = public_path('uploads/categories');
        if (!File::exists($destinationPath)) {
            File::makeDirectory($destinationPath, 0777, true, true);
        }
        $img = Image::read($image->path());
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
        return;
    }
}
