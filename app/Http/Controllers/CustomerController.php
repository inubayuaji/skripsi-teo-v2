<?php

namespace App\Http\Controllers;

use App\Models\Order;
use Illuminate\Contracts\View\View;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

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
        dd($req->file('payment_proof'));

        return redirect()
            ->back()
            ->with('message', 'Upload success');
    }
}
