<?php

namespace App\Http\Controllers\Actions;

use App\Http\Controllers\Controller;
use App\Models\Cart;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CartController extends Controller
{
    public function add(Request $request) {
        $customerId = Auth::guard('customer')->id();
        $productId = $request->query('product_id');
        $qtyOrdered = $request->query('qty_ordered');

        // check if stock avaliable
        $product = Product::where('id', $productId)
            ->first();

        if($product->stock < $qtyOrdered) {
            return redirect()
                ->back()
                ->with('fail_cart_add', 'Stock tidak mencukupi.');
        }

        // check if user already add product
        $cartItem = Cart::where('customer_id', $customerId)
            ->where('product_id', $productId)
            ->first();

        if(!$cartItem) {
            Cart::create([
                'customer_id' => $customerId,
                'product_id'=> $productId,
                'qty_ordered' => $qtyOrdered
            ]);
        }

        return redirect()
            ->back();
    }
    
    public function update(Request $request) {
        $customerId = Auth::guard('customer')->id();
        $productId = $request->query('product_id');
        $newQtyOrderd = $request->query('qty_ordered');

        Cart::where('customer_id', $customerId)
            ->where('product_id', $productId)
            ->update([
                'qty_ordered' => $newQtyOrderd
            ]);
    }

    public function remove(Request $request) {
        $customerId = Auth::guard('customer')->id();
        $productId = $request->query('product_id');

        Cart::where('customer_id', $customerId)
            ->where('product_id', $productId)
            ->delete();

        return redirect()
            ->back();
    }
}
