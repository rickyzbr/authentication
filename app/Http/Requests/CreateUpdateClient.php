<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CreateUpdateClient extends FormRequest
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
            'state_id' => 'required|numeric',
            'city_id' => 'required|numeric',
            'name' => 'required|unique:assistances|max:255',
            'cep' => 'required',
            'address' => 'required|max:99',
            'bairro' => 'required|max:60',
            'phone' => 'required',
            'celular' => 'required',
            'name' => 'required|max:255',
            'email' => 'required|max:99',
        ];
    }
}
