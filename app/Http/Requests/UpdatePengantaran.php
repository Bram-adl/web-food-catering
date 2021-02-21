<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdatePengantaran extends FormRequest
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
            'tanggal_kirim' => 'required|date',
            'porsi' => 'required|numeric|min:1',
            'waktu_kirim' => 'required|string',
            'lokasi' => 'required|string',
            'alamat' => 'required|string',
            'catatan_pelanggan' => 'nullable|string',
        ];
    }

    /**
     * Get the messages for the defined rules.
     * 
     * @return array
     */
    public function messages()
    {
        return [
            'tanggal_kirim.required' => 'Mohon mengisi tanggal.',
            'tanggal_kirim.after' => 'Pengiriman hanya dapat dilakukan mulai besok hari.',
            'lokasi.required' => 'Mohon menentukan lokasi pengiriman.',
            'porsi.required' => 'Mohon mengisi jumlah porsi.',
            'porsi.min' => 'Minimum 1 porsi pengantaran.',
            'waktu_kirim.required' => 'Mohon mengisi waktu pengiriman.',
            'alamat.required' => 'Mohon mengisi alamat pengiriman',
        ];
    }
}
