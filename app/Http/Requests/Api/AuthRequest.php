<?php

namespace App\Http\Requests\Api;

use App\Http\Requests\GeneralRequest;
use Illuminate\Contracts\Validation\ValidationRule;

class AuthRequest extends GeneralRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, ValidationRule|array|string>
     */
    public function rules(): array
    {
        return [
            'email' => 'required',
            'password' => 'required',
        ];
    }
}
