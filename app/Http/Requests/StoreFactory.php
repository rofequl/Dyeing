<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreFactory extends FormRequest
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
            'factory_name' => 'required|string|unique:factories|max:255',
            'phone' => 'max:255',
            'address' => 'max:500',
        ];
    }

    public function messages()
    {
        return [
            'factory_name.required' => 'Please enter factory name',
            'factory_name.unique' => 'This factory name already insert',
        ];
    }
}
