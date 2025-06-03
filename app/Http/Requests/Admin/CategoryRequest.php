<?php

namespace App\Http\Requests\Admin;

use App\Http\Requests\GeneralRequest;

class CategoryRequest extends GeneralRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'name' => [
                'required',
                'max:15',
                function ($attribute, $value, $fail) {
                    if (!$this->validStr('йцукенгшщзхъфывапролджэячсмитьбюё -', $value)) {
                        $fail('Некорректное значение');
                    }
                }
            ],
            'description' => [
                'nullable',
                'max:50',
                function ($attribute, $value, $fail) {
                    if (!$this->validStr('йцукенгшщзхъфывапролджэячсмитьбюё -.,:;', $value)) {
                        $fail('Некорректное значение');
                    }
                }
            ],
        ];
    }
}
