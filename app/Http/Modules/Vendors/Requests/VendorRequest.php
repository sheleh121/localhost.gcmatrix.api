<?php

namespace App\Http\Modules\Vendors\Requests;

use Illuminate\Foundation\Http\FormRequest;

class VendorRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            'name' => 'required|string|max:191',
            'address.legal' => 'required|string|max:191',
            'address.physical' => 'required|string|max:191',
            'email' => 'required|string|max:191',
            'description' => 'string|max:191',
            'files.*.name' => 'required|string|max:191',
            'files.*.id' => 'integer|max:100000000',
        ];
    }
}
