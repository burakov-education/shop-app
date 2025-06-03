<?php

namespace App\Http\Requests\Admin;

use App\Http\Requests\GeneralRequest;

class ProductRequest extends GeneralRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'name' => 'required|string|max:20',
            'description' => 'nullable|string|max:50',
            'price' => 'required|numeric|min:10',
            'images' => 'required|array|min:1',
            'images.*' => 'required|image|mimes:jpeg,png,jpg|max:' . (3.5 * 1024),
        ];
    }
}
