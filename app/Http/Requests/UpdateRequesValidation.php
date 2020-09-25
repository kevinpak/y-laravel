<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;

class UpdateRequesValidation extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return Auth::check();
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            "firstName"=> "string|max:255|min:3|required",
            "lastName" => "string|max:255|min:3|required",
            "email" => "email|max:255|required",
            "phone" => "max:50|required",
            "birthDate"=> "date_format:Y-m-d|before:today|nullable",
            "sex" => "required",
            "address" => "required|max:255",
            "salary" => "required|integer",
        ];
    }
}
