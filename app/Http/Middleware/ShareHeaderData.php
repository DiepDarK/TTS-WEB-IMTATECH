<?php

namespace App\Http\Middleware;

use Closure;
use App\Models\Cart;
use App\Models\Category;
use Illuminate\Support\Facades\View;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class ShareHeaderData
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        $cart = null;
        $categories = Category::all();
        if (Auth::check()) {
            // Nếu người dùng đã đăng nhập, lấy giỏ hàng của họ
            $user = Auth::user();
            $cart = Cart::where('user_id', $user->id)->first();
        }
        View::share('categories', $categories);
        View::share('cart', $cart);
        return $next($request);
    }
}
