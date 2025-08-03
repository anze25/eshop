<?php

namespace App\Http\Controllers\Admin;

use Carbon\Carbon;
use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;
use Intervention\Image\Laravel\Facades\Image;

class AdminUserController extends Controller
{
    /** USERS */
    public function users()
    {
        $users = User::orderBy('id', 'DESC')->paginate(10);
        return view('admin.users', compact('users'));
    }

    public function user_edit($id)
    {
        $user = User::findOrFail($id);
        return view('admin.user-edit', compact('user'));
    }

    public function user_update(Request $request)
    {
        $user = User::find($request->id);

        // Get the currently authenticated admin
        $adminUser = Auth::user();

        // Scenario 1: Admin is editing their own profile
        if ($adminUser->id == $user->id) {
            // If editing self, validate all fields
            $request->validate([
                'name' => 'required|min:3',
                'email' => 'required|email',
                'mobile' => 'nullable', // Or your custom phone rule
                'utype' => 'required',
                'image' => 'mimes:png,jpg,jpeg|max:4048',
            ]);
            if ($request->hasFile('image')) {
                if (File::exists(public_path('uploads/users/thumbnails') . '/' . $user->image)) {
                    File::delete(public_path('uploads/users/thumbnails') . '/' . $user->image);
                }
                $image = $request->file('image');
                $file_extention = $request->file('image')->extension();
                $file_name = Carbon::now()->timestamp . '.' . $file_extention;
                $this->GenerateUserThumbnailsImage($image, $file_name);
                $user->image = $file_name;
            }

            // And update all fields
            $user->name = $request->name;
            $user->email = $request->email;
            $user->mobile = $request->mobile;
            $user->utype = $request->utype;
        }
        // Scenario 2: Admin is editing a different user
        else {
            // If editing another user, only validate the 'utype'
            $request->validate([
                'utype' => 'required',
            ]);

            // And only update the 'utype'
            $user->utype = $request->utype;
        }



        // Save the changes to the database
        $user->save();

        return redirect()->route('admin.users')->with([
            'message' => __('Updated successfully!'),
            'alert-type' => 'info'
        ]);
    }

    public function user_delete($id)
    {
        $user = User::findOrFail($id);


        if ($user->orders->count() > 0) {
            // If the user has orders, redirect back with an error message.
            return redirect()->route('admin.users')->with([
                'message' => __('This user cannot be deleted because they have existing orders.'),
                'alert-type' => 'error' // Use 'error' for failure messages
            ]);
        }

        // If the user has no orders, proceed with deletion.
        $user->delete();

        return redirect()->route('admin.users')->with([
            'message' => __('Deleted successfully!'),
            'alert-type' => 'info'
        ]);
    }

    public function GenerateUserThumbnailsImage($image, $imageName)
    {
        $destinationPath = public_path('uploads/users/thumbnails');
        if (!File::exists($destinationPath)) {
            File::makeDirectory($destinationPath, 0777, true, true);
        }
        $img = Image::read($image->path());
        $img->cover(124, 124, 'top');
        $img->resize(124, 124, function ($constraint) {
            $constraint->aspectRatio();
        })
            ->save($destinationPath . '/' . $imageName);
        return;
    }
}
