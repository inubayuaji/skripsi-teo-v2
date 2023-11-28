<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreContactForm extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, mixed>
     */
    public function rules()
    {
        return [
            'name' => 'required',
            'phone_number' => 'required',
            'messages' => 'required|min:3'
        ];
    }

    /**
     * Custom message for validation
     *
     * @return array
     */
    public function messages()
    {
        return [
            'name.required' => 'Mohon isi nama.',
            'phone_number.required' => 'Mohon isi nomor telepon.',
            'messages.required' => 'Mohon isi pesan.',
            'messages.min' => 'Mohon isi pesan minimal tiga karakter.'
        ];
    }
}
