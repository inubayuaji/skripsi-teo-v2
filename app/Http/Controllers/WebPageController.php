<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use Illuminate\Contracts\View\View;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class WebPageController extends Controller
{
    function index(): View
    {
        return view('web.shop');
    }

    function about(): View
    {
        return view('web.about');
    }

    // function shop(): View
    // {
    //     return view('web.shop');
    // }

    function contact(): View
    {
        return view('web.contact');
    }

    function shopSingle() : View
    {
        return view('web.shop-single');
    }

    function cart() : View
    {
        $customerId = Auth::guard('customer')->id();
        $cartItems = Cart::where('customer_id', $customerId)
            ->get();
        $subtotals = 0;

        foreach($cartItems as $key => $cart) {
            $subtotals += $cart->product->price * $cart->qty_ordered;
        }

        // dd(json_encode($cartItemSubtotals, JSON_FORCE_OBJECT));
        
        return view('web.cart', [
            'cartItems' => $cartItems,
            'subtotals' => $subtotals
        ]);
    }

    function login() : View
    {
        return view('web.auth.login');
    }

    function register(): View
    {
        return view('web.auth.register');
    }
}
