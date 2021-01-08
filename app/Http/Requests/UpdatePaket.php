<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdatePaket extends FormRequest
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
            'paket' => 'required|string', 
            'porsi' => 'required|min:0|numeric',
            'id_kategori' => 'required', 
            'foto' => 'nullable|image|mimes:jpeg,jpg,png,svg|max:2048', 
            'harga' => 'required|numeric|min:0', 
            'pagi' => 'nullable', 
            'siang' => 'nullable', 
            'sore' => 'nullable',
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
            'paket.required' => 'Paket wajib diisi',
            'porsi.required' => 'Porsi wajib diisi',
            'porsi.min' => 'Minimal porsi adalah 0',
            'id_kategori.required' => 'Kategori wajib diisi',
            'foto.mimes' => 'Mohon pastikan gambar dalam format png, svg, jpeg, jpg',
            'foto.max' => 'Mohon pastikan ukuran gambar tidak lebih dari 2MB',
            'harga.required' => 'Harga wajib diisi',
            'harga.min' => 'Harga tidak kurang dari 0',
        ];
    }
}
