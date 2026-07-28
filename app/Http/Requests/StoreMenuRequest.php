<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreMenuRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'menu_id'   => ['required', 'string', 'max:3', 'unique:MENU,menu_id'],
            'id_level'  => ['required', 'string', 'exists:MENU_LEVEL,id_level'],
            'menu_name' => ['required', 'string', 'max:300'],
            'menu_link' => ['required', 'string', 'max:300'],
            'menu_icon' => ['nullable', 'string', 'max:300'],
            'parent_id' => ['nullable', 'string', 'exists:MENU,menu_id'],
        ];
    }
}
