<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class BookFilterRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            'author_id' => 'nullable|integer'
        ];
    }
}
