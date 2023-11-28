<?php

namespace App\Http\Controllers\Actions;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreContactForm as Request;
use App\Models\ContactForm;

class StoreContactForm extends Controller
{
    /**
     * Handle the incoming request.
     *
     * @param  \App\Http\Requests\StoreContactForm  $request
     * @return \Illuminate\Http\Response
     */
    public function __invoke(Request $request)
    {
        ContactForm::create($request->validated());

        return redirect()
            ->back()
            ->with('success', 'Pesan sudah terkirim.');
    }
}
