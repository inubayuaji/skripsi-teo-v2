<?php

namespace App\Http\Controllers\Actions;

use App\Http\Controllers\Controller;
use App\Models\Customer;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AuthCustomerController extends Controller
{
    public function register(Request $request)
    {
        if ($request->password != $request->retype_password) {
            return redirect()
                ->back()
                ->with('fail_create_costumer', 'Password tidak sama.');
        }

        $hassedPasword = Hash::make($request->password);

        Customer::create([
            'name' => $request->name,
            'email' => $request->email,
            'phone_number' => $request->phone_number,
            'password' => $hassedPasword
        ]);

        return redirect()
            ->route('web.auth.login')
            ->with('success_create_costumer', 'Akun berhasil dibuat, silahkan login.');
    }

    public function login(Request $request)
    {
        $customer = Customer::where('phone_number', $request->phone_number)
            ->first();

        if(!$customer) {
            return redirect()
                ->back()
                ->with('fail_login', 'Customer belum terdaftar.');
        }

        if(!Hash::check($request->password, $customer->password)) {
            return redirect()
                ->back()
                ->with('fail_login', 'Password salah.');
        }

        Auth::guard('customer')
            ->login($customer);

        return redirect()
            ->route('web.shop');
    }

    public function logout() {
        Auth::guard('customer')
            ->logout();

        return redirect()
            ->back();
    }
}
