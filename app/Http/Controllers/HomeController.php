<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Contact;
use App\Models\Product;
use App\Models\Slide;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $slides = Slide::with('translations')->where('status', 1)->get()->take(3);
        $categories = Category::with(['products' => function ($query) {
            $query->where('quantity', '>', 0);
        }])
            ->whereHas('products', function ($query) {
                $query->where('quantity', '>', 0);
            })
            ->inRandomOrder()
            ->get();

        $featuredCategories = $categories->take(2)->map(function ($category) {
            $minSale = $category->products
                ->whereNotNull('sale_price')
                ->min('sale_price');

            $minRegular = $category->products->min('regular_price');
            $category->min_price = $minSale ?? $minRegular;

            return $category;
        });

        $saleProducts = Product::whereNotNull('sale_price')->where('sale_price', '<>', '')->inRandomOrder()->get()->take(4);
        $featuredProducts = Product::where('featured', 1)->inRandomOrder()->get()->take(4);

        return view('index', compact('slides', 'saleProducts', 'featuredProducts', 'categories', 'featuredCategories'));
    }

    public function about()
    {
        return view('about');
    }

    public function contact()
    {
        return view('contact');
    }

    public function contact_store(Request $request)
    {
        $request->validate([
            'name' => 'required|max:100',
            'phone' => ['nullable', 'regex:/^(\+?\d{1,3}[-.\s]?)?(\(?\d{3}\)?[-.\s]?)?\d{3}[-.\s]?\d{4}$/'],
            'email' => 'required|email',
            'subject' => 'required|min:3|max:50',
            'comment' => 'required|min:5',

        ]);
        $contact = new Contact();
        $contact->name = $request->name;
        $contact->phone = $request->phone;
        $contact->email = $request->email;
        $contact->comment = $request->comment;
        $contact->subject = $request->subject;
        $contact->save();

        return redirect()->back()->with('message', __('Message sent successfully!'));
    }

    public function search(Request $request)
    {
        $query = $request->input('query');
        $results = Product::whereHas('translations', function ($translationQuery) use ($query) {
            $translationQuery->where('name', 'LIKE', "%{$query}%")
                ->where('locale', app()->getLocale());
        })->with(['translations' => function ($query) {
            $query->where('locale', app()->getLocale()); // Load only the current locale
        }])->take(8)->get();

        return response()->json($results);
    }
}
