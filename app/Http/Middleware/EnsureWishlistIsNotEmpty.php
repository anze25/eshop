<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Surfsidemedia\Shoppingcart\Facades\Cart;
use Symfony\Component\HttpFoundation\Response;

class EnsureWishlistIsNotEmpty
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        if (Cart::instance('wishlist')->content()->count() === 0) {
            return redirect()->route('shop.index')->with([
                'message' => __('Your wishlist is empty!'),
                'alert-type' => 'warning'
            ]);
        }
        return $next($request);
    }
}
