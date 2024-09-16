<?php

namespace App\Http\Controllers;

use App\Models\Order;
use Illuminate\Contracts\View\View;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;

class CustomerController extends Controller
{
    public function profil(): View
    {
        $profil = Auth::guard('customer')
            ->user();

        return view('web.customer.profil', [
            'profil' => $profil
        ]);
    }

    public function order(): View
    {
        $customerId = Auth::guard('customer')
            ->id();
        $orderList = Order::where('costumer_id', $customerId)
            ->get();

        return view('web.customer.order', [
            'orderList' => $orderList
        ]);
    }

    public function uploadForm(int $orderId): View
    {
        return view('web.customer.upload', [
            'orderId' => $orderId
        ]);
    }

    public function uploadData(Request $req, int $orderId)
    {
        $order = Order::find($orderId);
        $path = $req->file('payment_proof')->store('public/images/payments');
        $path = Str::replace('public/', '', $path);

        $order->payment_proof = $path;
        $order->save();

        return redirect()
            ->back()
            ->with('message', 'Upload success');
    }

    public function invoice(int $orderId)
    {
        $order = Order::findOrFail($orderId);

        return view('web.customer.invoice', [
            'order' => $order
        ]);
    }
}
