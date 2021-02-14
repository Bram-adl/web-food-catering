<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreJabatan extends FormRequest
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
            'jabatan' => 'required',
            'keterangan' => 'required',
            'warna' => 'required',
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
            'jabatan.required' => 'Jabatan wajib diisi',
            'keterangan.required' => 'Keterangan wajib diisi',
            'warna.required' => 'Warna wajib disii',
        ];
    }
}
