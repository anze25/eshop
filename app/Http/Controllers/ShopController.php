<?php

namespace App\Http\Controllers;

use App\Models\Brand;
use App\Models\Category;
use App\Models\Product;
use Illuminate\Http\Request;

class ShopController extends Controller
{
    public function index(Request $request)
    {
        $size = $request->query('size', 6);
        $order = $request->query('order', -1);
        $filteredBrands = $request->query('brands');
        $filteredCategories = $request->query('categories');
        $min_price = $request->query('min', 1);
        $max_price = $request->query('max', 1000);

        // Determine sorting column and direction
        switch ($order) {
            case 1:
                $columnOrder = 'created_at';
                $orderDirection = 'DESC';
                break;
            case 2:
                $columnOrder = 'created_at';
                $orderDirection = 'ASC';
                break;
            case 3:
                $columnOrder = 'sale_price';
                $orderDirection = 'ASC';
                break;
            case 4:
                $columnOrder = 'sale_price';
                $orderDirection = 'DESC';
                break;
            default:
                $columnOrder = 'id';
                $orderDirection = 'DESC';
        }

        $brands = Brand::with(['products' => fn($q) => $q->where('quantity', '>', 0)])
            ->whereHas('products', fn($q) => $q->where('quantity', '>', 0))
            ->orderBy('name')
            ->get();


        $categories = Category::with(['translations', 'products'])->whereHas('products', fn($q) => $q->where('quantity', '>', 0))->get();


        $products = Product::with([
            'translations' => fn($q) => $q->where('locale', app()->getLocale()),
            'category.translations' => fn($q) => $q->where('locale', app()->getLocale()),
            'brand' // if you need brand info in the view
        ])
            ->where('quantity', '>', 0)
            ->when($filteredBrands, fn($q) => $q->whereIn('brand_id', explode(',', $filteredBrands)))
            ->when($filteredCategories, fn($q) => $q->whereIn('category_id', explode(',', $filteredCategories)))
            ->where(function ($q) use ($min_price, $max_price) {
                $q->whereBetween('regular_price', [$min_price, $max_price])
                    ->orWhereBetween('sale_price', [$min_price, $max_price]);
            })
            ->orderBy($columnOrder, $orderDirection)
            ->paginate($size);


        // Calculate current price range within filtered products
        $current_min_price = $products->min('regular_price');
        $current_max_price = $products->max('regular_price');

        return view('shop', compact(
            'products',
            'size',
            'order',
            'brands',
            'filteredBrands',
            'categories',
            'filteredCategories',
            'min_price',
            'max_price',
            'current_min_price',
            'current_max_price'
        ));
    }

    public function product_details($product_slug)
    {
        $product = Product::with('translations')->where('slug', $product_slug)->first();
        $relatedProducts = Product::with('translations')->where('slug', '<>', $product_slug)->get()->take(8);
        return view('details', compact('product', 'relatedProducts'));
    }
}
