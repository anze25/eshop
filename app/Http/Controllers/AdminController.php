<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Brand;
use App\Models\Order;
use App\Models\Slide;
use App\Models\Product;
use App\Models\Category;
use App\Models\SiteSetting;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;
use Intervention\Image\Laravel\Facades\Image;

class AdminController extends Controller
{
    public function index()
    {
        $orders = Order::orderBy('created_at', 'DESC')->get()->take(10);
        $dashboardData = DB::select('
        SELECT 
            SUM(total) AS TotalAmount,
            SUM(IF(status = "ordered", total, 0)) AS TotalOrderedAmount,
            SUM(IF(status = "delivered", total, 0)) AS TotalDeliveredAmount,
            SUM(IF(status = "canceled", total, 0)) AS TotalCanceledAmount,
            COUNT(*) AS Total,
            SUM(IF(status = "ordered", 1, 0)) AS TotalOrdered,
            SUM(IF(status = "delivered", 1, 0)) AS TotalDelivered,
            SUM(IF(status = "canceled", 1, 0)) AS TotalCanceled
        FROM orders
        ');
        $monthlyData = DB::select('
        SELECT 
            M.id AS monthNo, 
            M.name AS MonthName,
            IFNULL(d.TotalAmount, 0) AS TotalAmount,
            IFNULL(d.TotalOrderedAmount, 0) AS TotalOrderedAmount,
            IFNULL(d.TotalDeliveredAmount, 0) AS TotalDeliveredAmount,
            IFNULL(d.TotalCanceledAmount, 0) AS TotalCanceledAmount
        FROM 
            month_names M
        LEFT JOIN (
            SELECT 
                DATE_FORMAT(created_at, "%b") AS MonthName,
                MONTH(created_at) AS MonthNo,
                SUM(total) AS TotalAmount,
                SUM(IF(status = "ordered", total, 0)) AS TotalOrderedAmount,
                SUM(IF(status = "delivered", total, 0)) AS TotalDeliveredAmount,
                SUM(IF(status = "canceled", total, 0)) AS TotalCanceledAmount
            FROM 
                orders
            WHERE 
                YEAR(created_at) = YEAR(NOW())
            GROUP BY 
                YEAR(created_at), MONTH(created_at), DATE_FORMAT(created_at, "%b")
            ORDER BY 
                MONTH(created_at)
        ) d ON d.MonthNo = M.id
        ');


        $amountM = implode(',', collect($monthlyData)->pluck('TotalAmount')->toArray());
        $orderedAmount = implode(',', collect($monthlyData)->pluck('TotalOrderedAmount')->toArray());
        $deliveredAmount = implode(',', collect($monthlyData)->pluck('TotalDeliveredAmount')->toArray());
        $canceledAmount = implode(',', collect($monthlyData)->pluck('TotalCanceledAmount')->toArray());

        $totalAmount = collect($monthlyData)->sum('TotalAmount');
        $totalOrderedAmount = collect($monthlyData)->sum('TotalOrderedAmount');
        $totalDeliveredAmount = collect($monthlyData)->sum('TotalDeliveredAmount');
        $totalCanceledAmount = collect($monthlyData)->sum('TotalCanceledAmount');



        return view('admin.index', compact(
            'orders',
            'dashboardData',
            'monthlyData',
            'amountM',
            'orderedAmount',
            'deliveredAmount',
            'canceledAmount',
            'totalAmount',
            'totalOrderedAmount',
            'totalDeliveredAmount',
            'totalCanceledAmount',

        ));
    }

    public function search(Request $request)
    {

        $query = $request->input('query');
        $searchType = $request->input('type'); // Retrieve search type

        $modelMap = [
            'brands' => Brand::class,
            'categories' => Category::class,
            'products' => Product::class,
            'slides' => Slide::class,
            'users' => User::class,
        ];

        if (!isset($modelMap[$searchType])) {
            return response()->json(['error' => 'Invalid search type'], 400);
        }

        $model = $modelMap[$searchType];

        // Check if the model has the 'translations' relationship
        $hasTranslations = method_exists($model, 'translations');

        if ($hasTranslations) {
            $results = $model::whereHas('translations', function ($translationQuery) use ($query) {
                $translationQuery->where('name', 'LIKE', "%{$query}%")
                    ->where('locale', app()->getLocale());
            })->with(['translations' => function ($query) {
                $query->where('locale', app()->getLocale());
            }])->take(8)->get();
        } else {
            // If model doesn't have translations, search directly
            $results = $model::where('name', 'LIKE', "%{$query}%")->take(8)->get();
        }

        return response()->json($results);
    }

    public function settings()
    {
        $settings = SiteSetting::find(1);
        return view('admin.settings', compact('settings'));
    }

    public function settings_update(Request $request)
    {
        $settings = SiteSetting::find(1);
        if ($request->hasFile('logo')) {
            if (File::exists(public_path('assets/images') . '/' . $settings->image)) {
                File::delete(public_path('assets/images') . '/' . $settings->image);
            }

            $image = $request->file('logo');
            $file_name = 'logo' . '.' . $image->getClientOriginalExtension();
            $this->GenerateLogo($image, $file_name);

            SiteSetting::find(1)->update([
                'phone_one' => $request->phone_one,
                'phone_two' => $request->phone_two,
                'email' => $request->email,
                'company_name' => $request->company_name,
                'company_address' => $request->company_address,
                'facebook' => $request->facebook,
                'twitter' => $request->twitter,
                'linkedin' => $request->linkedin,
                'youtube' => $request->youtube,
                'logo' => $file_name,

            ]);


            return redirect()->back()->with([
                'message' => __('Updated successfully!'),
                'alert-type' => 'info'
            ]);
        } else {

            SiteSetting::find(1)->update([
                'phone_one' => $request->phone_one,
                'phone_two' => $request->phone_two,
                'email' => $request->email,
                'company_name' => $request->company_name,
                'company_address' => $request->company_address,
                'facebook' => $request->facebook,
                'twitter' => $request->twitter,
                'linkedin' => $request->linkedin,
                'youtube' => $request->youtube,

            ]);



            return redirect()->back()->with([
                'message' => __('Updated successfully!'),
                'alert-type' => 'info'
            ]);
        } // end else 
    }

    public function GenerateLogo($image, $imageName)
    {
        $destinationPath = public_path('assets/images');

        $img = Image::read($image->getPathname());
        $img->scaleDown(738, 177);

        $img->save($destinationPath . '/' . $imageName);
        return;
    }
};
