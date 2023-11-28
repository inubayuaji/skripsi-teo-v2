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
        return view('web.index');
    }

    function about(): View
    {
        return view('web.about');
    }

    function shop(): View
    {
        return view('web.shop');
    }

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
        
        return view('web.cart', [
            'cartItems' => $cartItems
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
