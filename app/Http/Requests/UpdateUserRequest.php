<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UpdateUserRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        $userId = $this->route('user');

        return [
            'nama_user'     => ['required', 'string', 'max:100'],
            'username'      => ['required', 'string', 'max:50', Rule::unique('USER', 'username')->ignore($userId, 'id_user')],
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
            'nama_user'     => 'Nama User',
            'username'      => 'Username',
            'email'         => 'Email',
            'no_hp'         => 'No. HP',
            'wa'            => 'WhatsApp',
            'id_jenis_user' => 'Jenis User',
            'status_user'   => 'Status',
        ];
    }
}
