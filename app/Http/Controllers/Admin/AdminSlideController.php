<?php

namespace App\Http\Controllers\Admin;

use Carbon\Carbon;
use App\Models\Slide;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\File;
use Intervention\Image\Laravel\Facades\Image;

class AdminSlideController extends Controller
{
    /** SLIDERS */
    public function slides()
    {
        $slides = Slide::orderBy('id', 'DESC')->paginate(10);
        return view('admin.slides', compact('slides'));
    }

    public function slide_add()
    {
        return view('admin.slide-add');
    }

    public function slide_store(Request $request)
    {
        $rules = [
            'link' => 'required|url',
            'image' => 'required|mimes:png,jpg,jpeg|max:2048',
            'status' => 'required',

        ];
        // Add dynamic validation rules for each locale
        foreach (config('app.supported_locales') as $locale) {
            $rules["{$locale}.title"] = ['required', 'max:200', "unique:slide_translations,title,NULL,id,locale,{$locale}"];
            $rules["{$locale}.tagline"] = ['required', 'max:200'];
            $rules["{$locale}.subtitle"] = ['required', 'max:200'];
        }

        $validatedData = $request->validate($rules);
        $image = $request->file('image');
        $file_extention = $image->extension();

        $file_name = Carbon::now()->timestamp . '.' . $file_extention;
        $this->GenerateSlideThumbnailsImage($image, $file_name);


        // Prepare base news data
        $slideData = [
            'slug' => Str::slug($request->input("{$locale}.title")),
            'link' => $request->link,
            'status' => $request->status,
            'image' => $file_name,
        ];

        // Prepare translation data
        $translations = [];
        foreach (config('app.supported_locales') as $locale) {
            $translations[$locale] = [
                'locale' => $locale,
                'title' => $request->input("{$locale}.title"),
                'tagline' => $request->input("{$locale}.tagline"),
                'subtitle' => $request->input("{$locale}.subtitle"),
            ];
        }

        // Create category entry with translations
        $slide = Slide::create($slideData);
        $slide->translations()->createMany($translations);


        return redirect()->route('admin.slides')->with([
            'message' => __('Created successfully!'),
            'alert-type' => 'success'
        ]);
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

    public function slide_edit($id)
    {
        $slide = Slide::findOrFail($id);
        return view('admin.slide-edit', compact('slide'));
    }

    public function slide_update(Request $request)
    {
        $rules = [
            'link' => 'required|url',
            'image' => 'nullable|mimes:png,jpg,jpeg|max:2048',
            'status' => 'required',

        ];
        // Add dynamic validation rules for each locale
        foreach (config('app.supported_locales') as $locale) {
            $rules["{$locale}.title"] = ['required', 'max:200', Rule::unique('slide_translations', 'title')->ignore($request->id, 'slide_id')];
            $rules["{$locale}.tagline"] = ['required', 'max:200'];
            $rules["{$locale}.subtitle"] = ['required', 'max:200'];
        }

        $validatedData = $request->validate($rules);

        $slide = Slide::find($request->id); // hidden input in edit.blade


        $file_name = null;
        if ($request->hasFile('image')) {
            if (File::exists(public_path('uploads/slides') . '/' . $slide->image)) {
                File::delete(public_path('uploads/slides') . '/' . $slide->image);
            }

            $image = $request->file('image');
            $file_extention = $image->extension();

            $file_name = Carbon::now()->timestamp . '.' . $file_extention;
            $this->GenerateSlideThumbnailsImage($image, $file_name);
            $slide->image = $file_name;
        }

        // Prepare base news data
        $slideData = [
            'slug' => Str::slug($request->input("{$locale}.title")),
            'link' => $request->link,
            'status' => $request->status,
            'image' => $file_name ? $file_name : $slide->image,
        ];


        // Update translations
        $translations = [];
        foreach (config('app.supported_locales') as $locale) {
            $slide->translations()->updateOrCreate(
                ['locale' => $locale],
                [
                    'title' => $request->input("{$locale}.title"),
                    'tagline' => $request->input("{$locale}.tagline"),
                    'subtitle' => $request->input("{$locale}.subtitle")
                ]
            );
        }

        $slide->update($slideData);


        return redirect()->route('admin.slides')->with([
            'message' => __('Updated successfully!'),
            'alert-type' => 'info'
        ]);
    }

    public function slide_delete($id)
    {
        $slide = Slide::findOrFail($id);
        if (File::exists(public_path('uploads/slides') . '/' . $slide->image)) {
            File::delete(public_path('uploads/slides') . '/' . $slide->image);
        }
        $slide->delete();
        $slide->translations()->delete();
        return redirect()->route('admin.slides')->with([
            'message' => __('Deleted successfully!'),
            'alert-type' => 'info'
        ]);
    }
}
