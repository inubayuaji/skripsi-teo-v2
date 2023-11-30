<?php

namespace App\Http\Controllers\Actions;

use App\Http\Controllers\Controller;
use App\Models\Cart;
use App\Models\Order;
use App\Models\OrderLine;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;

class CakeoutOrderController extends Controller
{
    /**
     * Handle the incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function __invoke(Request $request)
    {   
        $customerId = Auth::guard('customer')->id();
        $shipmentAddress = $request->shipment_address;

        // check if stock mencukupi
        $unavaliableStockProducts = $this->checkStock($customerId);

        if($unavaliableStockProducts) {
            return $unavaliableStockProducts;
        }

        // create order
        $order = $this->createOrder($customerId, $shipmentAddress);

        // create lines
        $this->createOrderLine($customerId, $order->id);

        // clear cart
        $this->clearCart($customerId);

        // return redirect()
        //     ->route('/success_create_order')

        return 'Sukses';
    }

    private function createOrder($customerId, $shipmentAddress) {
        $invoiceNo = $this->createInvoiceNo();
        $amoutTotal = $this->countAmountTotal($customerId);

        $order = Order::create([
            'no_invoice' => $invoiceNo,
            'costumer_id' => $customerId,
            'amount_total' => $amoutTotal,
            'shipment_total' => 15000, # nanti lihat database config shipment fee
            'shipment_address' => $shipmentAddress,
            'status' => 'N' # new
        ]);

        return $order;
    }

    private function checkStock($customerId) {
        $unavaliableStockProducts = [];
        $cartItmes = Cart::where('customer_id', $customerId)
            ->get();

        foreach($cartItmes as $item) {
            if($item->product->stock < $item->qty_ordered) {
                array_push($unavaliableStockProducts, $item->product->name);
            }
        }

        if(!empty($unavaliableStockProducts)) {
            return $unavaliableStockProducts;
        }

        return [];
    }

    private function createOrderLine($customerId, $orderId) {
        $cartItmes = Cart::where('customer_id', $customerId)
            ->get();

        foreach ($cartItmes as $item) {
            $productPrice = $item->product->price;
            $lineAmoutTotal = $item->qty_ordered * $productPrice;

            // decrease produk stock
            $produk = Product::where('id', $item->product_id)
                ->first();
            $produk->stock = $produk->stock - $item->qty_ordered;
            $produk->save();

            OrderLine::create([
                'order_id' => $orderId,
                'product_id' => $item->product_id,
                'quantity' => $item->qty_ordered,
                'price' => $productPrice,
                'amount_total' => $lineAmoutTotal
            ]);
        }
    }

    private function createInvoiceNo() {
        $tanggal = now()->format('Ymd');
        $randomString = Str::upper(Str::random(5));

        return 'INVC/' . $tanggal . '/' . $randomString;
    }

    private function countAmountTotal($customerId) {
        $total = 0;
        $cartItmes = Cart::where('customer_id', $customerId)
            ->get();

        foreach($cartItmes as $item) {
            $total += $item->product->price * $item->qty_ordered;
        }

        return $total;
    }

    private function clearCart($customerId) {
        Cart::where('customer_id', $customerId)
            ->delete();
    }
}
