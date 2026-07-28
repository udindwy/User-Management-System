<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rules\Password;

class StoreUserRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'id_user'       => ['required', 'string', 'max:30', 'unique:USER,id_user'],
            'nama_user'     => ['required', 'string', 'max:100'],
            'username'      => ['required', 'string', 'max:50', 'unique:USER,username'],
            'password'      => ['required', Password::min(8)->mixedCase()->numbers()],
            'email'         => ['nullable', 'email', 'max:100'],
            'no_hp'         => ['nullable', 'string', 'max:20'],
            'wa'            => ['nullable', 'string', 'max:20'],
            'id_jenis_user' => ['required', 'string', 'exists:JENIS_USER,id_jenis_user'],
            'status_user'   => ['required', 'in:AKTIF,NONAKTIF'],
        ];
    }

    public function attributes(): array
    {
        return [
            'id_user'       => 'ID User',
            'nama_user'     => 'Nama User',
            'username'      => 'Username',
            'password'      => 'Password',
            'email'         => 'Email',
            'no_hp'         => 'No. HP',
            'wa'            => 'WhatsApp',
            'id_jenis_user' => 'Jenis User',
            'status_user'   => 'Status',
        ];
    }
}
