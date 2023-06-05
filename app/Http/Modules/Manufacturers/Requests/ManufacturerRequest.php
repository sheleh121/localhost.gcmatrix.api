<?php

namespace App\Http\Modules\Manufacturers\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ManufacturerRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            'name' => 'required|string|max:191',
            'country' => 'required|string|max:191',
            'city' => 'required|string|max:191',
            'street' => 'required|string|max:191',
            'email' => 'required|string|max:191',
            'description' => 'string|max:191',
            'files.*.name' => 'required|string|max:191',
            'files.*.id' => 'integer|max:100000000',
        ];
    }
}
