<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateProfile extends FormRequest
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
            'nama' => 'required|string|max:255',
            'wa' => [
                'nullable',
                'numeric',
                'regex:/^(^\+62\s?|^0)(\d{3,4}-?){2}\d{3,4}$/',
            ],
            'jenis_kelamin' => 'required|string',
            'tempat_lahir' => 'required|string',
            'tanggal_lahir' => 'required|date',
            'alamat' => 'required|string',
            'id_kota' => 'sometimes',
            'id_kecamatan' => 'sometimes',
            'id_kelurahan' => 'sometimes',
        ];
    }
}
