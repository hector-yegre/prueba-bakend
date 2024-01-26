<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Http\Exceptions\HttpResponseException;

class ClientPostRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    // public function authorize(): bool
    // {
    //     return false;
    // }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            "name"=>"required",
            "last_name"=>"required",
            "license"=>"required",
            "phone_number"=>"required||min:10",
            "email"=>"required",
            "addres"=>"required",
        ];
    }
    
    public function failedValidation(Validator $validator)
    {

        throw new HttpResponseException(response()->json([
            'success'   => false,
            'message'   => 'Validation errors',
            'data'      => $validator->errors()
        ]));
    }

    public function messages()
    {
        return [
            "name.required"=>"The name is required",
            "last_name.required"=>"The last name is required",
            "license.required"=>"The lincence is required",
            "phone_number.required"=>"the Phone number is required",
            "email.required"=>"The email is required",
            "addres.required"=>"the address is required"
        ];
    }

}
