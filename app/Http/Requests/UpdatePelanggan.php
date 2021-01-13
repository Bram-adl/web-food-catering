<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;

class UpdatePelanggan extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {   
        return [
            'nama' => 'required|string',
            'email' => 'required|email|unique:pelanggan,email,'.Auth::user()->id,
            'password' => 'nullable|string|min:4',
            'wa' => [
                'nullable',
                'numeric',
                'regex:/^(^\+62\s?|^0)(\d{3,4}-?){2}\d{3,4}$/',
            ],
            'rumah_teks' => 'nullable|string',
            'rumah_maps' => 'nullable|url',
            'rumah_kota' => 'nullable',
            'rumah_kecamatan' => 'nullable',
            'rumah_kelurahan' => 'nullable',
            'kantor_teks' => 'nullable|string',
            'kantor_maps' => 'nullable|url',
            'kantor_kota' => 'nullable',
            'kantor_kecamatan' => 'nullable',
            'kantor_kelurahan' => 'nullable',
            'keterangan' => 'nullable|string',
            'porsi' => 'nullable|numeric',
        ];
    }

    /**
     * Get the error messages for the defined validation rules.
     */
    public function messages()
    {
        return [
            'nama.required' => 'Nama wajib diisi',
            'email.required' => 'Email wajib diisi',
            'email.email' => 'Mohon sertakan email yang valid',
            'email.unique' => 'Email telah terdaftar',
            'password.required' => 'Password wajib diisi',
            'password.min' => 'Minimal 4 karakter password',
            'wa.regex' => 'Mohon sertakan nomor WA yang valid',
            'rumah_maps.url' => 'Mohon sertakan link yang valid',
            'kantor_maps' => 'Mohon sertakan link yang valid',
        ];
    }
}
