<?php

namespace App\Http\Controllers\Actions;

use App\Http\Controllers\Controller;
use App\Models\Cart;
use Illuminate\Http\Request;

class HandleCartController extends Controller
{
    public function add(Request $request)
    {
        Cart::create([
            'customer_id' => $request->customer_id,
            'product_id' => $request->product_id,
            'qty_ordered' => $request->qty_ordered
        ]);

        return redirect()
            ->back();
    }

    public function remove(Request $request)
    {
        Cart::where('customer_id', $request->customer_id)
            ->where('product_id', $request->product_id)
            ->delete();

        return redirect()
            ->back();
    }
}
