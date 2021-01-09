<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StorePembelian extends FormRequest
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
            'id_pelanggan' => 'required',
            'id_paket' => 'required',
            'bukti_bayar' => 'nullable|image|mimes:jpeg, jpg, png, svg|max:2048',
            'status' => 'nullalbe|string',
            'lokasi' => 'required|string',
            'alamat' => 'required|string',
            'waktu_pengiriman' => 'required|string',
            'tanggal_mulai' => 'required|string',
        ];
    }

    /**
     * Get the error messages for the defined validation rules.
     */
    public function messages()
    {
        return [
            'id_pelanggan.required' => 'Pelanggan wajib dipilih',
            'id_paket.required' => 'Paket wajib dipilih',
            'bukti_bayar.mimes' => 'Mohon pastikan foto dalam format jpeg, jpg, png, atau svg',
            'bukti_bayar.max' => 'Mohon pastikan foto tidak lebih dari 2mb',
            'status' => 'Status wajib dipilih',
        ];
    }
}
