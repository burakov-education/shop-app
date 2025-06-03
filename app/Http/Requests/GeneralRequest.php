<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class GeneralRequest extends FormRequest
{
    /**
     * Valid string by symbols
     *
     * @param string $validSymbols
     * @param string $userSymbols
     * @return bool
     */
    public function validStr(string $validSymbols, string $userSymbols): bool
    {
        $arr = str_split(mb_strtolower($userSymbols));

        foreach ($arr as $k => $v) {
            if (mb_strpos($validSymbols, $v) === false) {
                return false;
            }
        }

        return true;
    }
}
