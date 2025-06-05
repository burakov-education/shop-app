<?php

namespace App\Http\Requests\Api;

use App\Http\Requests\GeneralRequest;
use Illuminate\Contracts\Validation\ValidationRule;

class RegistrationRequest extends GeneralRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, ValidationRule|array|string>
     */
    public function rules(): array
    {
        return [
            'email' => 'required|email|unique:users,email',
            'password' => [
                'required',
                'string',
                'min:5',
                function ($attribute, $value, $fail) {
                    $validStr = 'qwertyuiopasdfghjklzxcvbnm#_-$';

                    if (!$this->validStr($validStr, mb_strtolower($value))) {
                        return $fail('Invalid password format.');
                    }

                    $existsStrArr = [
                        'qwertyuiopasdfghjklzxcvbnm',
                        mb_strtoupper('qwertyuiopasdfghjklzxcvbnm'),
                        '#_-$',
                    ];

                    $valueArr = str_split($value);
                    foreach ($existsStrArr as $existStr) {
                        $exists = false;

                        foreach ($valueArr as $valueSymbol) {
                            if (mb_strpos($existStr, $valueSymbol) !== false) {
                                $exists = true;
                                break;
                            }
                        }

                        if (!$exists) {
                            return $fail('Invalid password format.');
                        }
                    }
                }
            ],
        ];
    }
}
