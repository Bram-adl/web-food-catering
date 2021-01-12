<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StorePengantaran extends FormRequest
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
            'tanggal' => 'required|date|after:today',
            'porsi' => 'required|numeric|min:1',
            'waktu' => 'required|string',
            'alamat' => 'required|string',
            'catatan' => 'nullable|string',
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
            'tanggal.required' => 'Mohon mengisi tanggal.',
            'tanggal.after' => 'Pengiriman hanya dapat dilakukan mulai besok hari.',
            'porsi.required' => 'Mohon mengisi jumlah porsi.',
            'porsi.min' => 'Minimum 1 porsi pengantaran.',
            'waktu.required' => 'Mohon mengisi waktu pengiriman.',
            'alamat.required' => 'Mohon mengisi alamat pengiriman',
        ];
    }
}
