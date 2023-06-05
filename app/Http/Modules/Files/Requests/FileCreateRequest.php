<?php

namespace App\Http\Modules\Files\Requests;

use Illuminate\Foundation\Http\FormRequest;

class FileCreateRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            'related_id' => 'required|integer|max:100000000',
            'related_type' => 'required|string|max:191',
            'name' => 'required|string|max:191',
        ];
    }
}
