<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;


class EmployeesCategorieValidation extends FormRequest
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
     * Get the validation rules that apply to the request imcoming in
     * EmployeesCategorie controller
     *
     * @return array
     */
    public function rules()
    {
        return [
            "name" => "required|max:255|min:3",
            "description" => "required|string",
        ];
    }
}
