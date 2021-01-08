<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StorePersonel extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'nik' => 'required|numeric',
            'nama' => 'required|string|max:100',
            'email' => 'required|email|max:100|unique:personel,email|ends_with:@senjani.id',
            'password' => 'required|string|min:4',
            'id_jabatan' => 'required|numeric',
            'wa' => [
                'nullable',
                'numeric',
                'regex:/^(^\+62\s?|^0)(\d{3,4}-?){2}\d{3,4}$/',
            ],
            'jenis_kelamin' => 'required|string',
            'tempat_lahir' => 'required|string|max:50',
            'tanggal_lahir' => 'required|date|date_format:Y-m-d|before:today',
            'alamat' => 'nullable',
            'id_kota' => 'required',
            'id_kecamatan' => 'required',
            'id_kelurahan' => 'required',
            'foto' => 'required|image|mimes:jpeg,jpg,png,svg|max:2048',
        ];
    }

    /**
     * Get the error messages for the defined validation rules.
     *
     * @return array
     */
    public function messages()
    {
        return [
            'nik.required' => 'NIK wajib diisi',
            'nik.numeric' => 'NIK harus berupa digit',
            'email.required' => 'Email wajib diisi',
            'email.unique' => 'Email sudah digunakan akun lain.',
            'email.ends_with' => 'Email wajib berakhiran @senjani.id',
            'nama.required' => 'Nama wajib diisi',
            'nama.string' => 'Nama harus berupa huruf',
            'password.required' => 'Password wajib diisi',
            'password.min' => 'Minimal 4 karakter',
            'wa.numeric' => 'WA harus berupa nomor yang valid',
            'wa.regex' => 'Mohon sertakan nomor WA yang valid',
            'jenis_kelamin.required' => 'Jenis kelamin wajib diisi',
            'tempat_lahir.required' => 'Tempat lahir wajib diisi',
            'tanggal_lahir.required' => 'Tanggal lahit wajib diisi',
            'tanggal_lahir.before' => 'Mohon berikan tanggal lahir yang valid',
            'id_jabatan.required' => 'Jabatan wajib diisi',
            'foto.required' => 'Foto wajib diisi',
            'id_kota.required' => 'Kota wajib disi',
            'id_kecamatan.required' => 'Kecamatan wajib disi',
            'id_kelurahan.required' => 'Kelurahan wajib disi',
        ];
    }
}
