<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StorecompaniesRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return false;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, mixed>
     */
    public function rules()
    {
        return [
            'name' => 'required',
            'address' => 'required',
            'phone' => 'required',
            'email' => 'required',
            'website' => 'required',
            'logo' => 'required',
            'description' => 'required',
            'industry' => 'required',
            'number_of_employees' => 'required',
            'tax_code' => 'required',
        ];
    }
}
