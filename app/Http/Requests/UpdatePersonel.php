<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdatePersonel extends FormRequest
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
            'nama' => 'required|string',
            'id_jabatan' => 'required',
            'wa' => [
                'required',
                'numeric',
                'regex:/^(^\+62\s?|^0)(\d{3,4}-?){2}\d{3,4}$/'
            ],
            'jenis_kelamin' => 'required',
            'tempat_lahir' => 'required|string|max:50',
            'tanggal_lahir' => 'required|date|date_format:Y-m-d|before:today',
            'alamat' => 'sometimes|nullable',
            'id_kota' => 'required',
            'id_kecamatan' => 'required',
            'id_kelurahan' => 'required',
            'foto' => 'sometimes|nullable',
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
            'nama.required' => 'Nama wajib diisi',
            'wa.required' => 'Nomor WA wajib diisi',
            'wa.numeric' => 'WA harus berupa nomor yang valid',
            'wa.regex' => 'Mohon sertakan nomor WA yang valid',
            'jenis_kelamin.required' => 'Jenis kelamin wajib diisi',
            'id_jabatan.required' => 'Jabatan wajib diisi',
            'tempat_lahir.required' => 'Tempat lahir wajib diisi',
            'tanggal_lahir.required' => 'Tanggal lahit wajib diisi',
            'tanggal_lahir.before' => 'Mohon berikan tanggal lahir yang valid',
        ];
    }
}
