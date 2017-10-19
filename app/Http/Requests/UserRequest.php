<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Auth;

class UserRequest extends FormRequest
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
        $id = Auth::user()->id;

        return [
            "name"                  => 'required',
            "email"                 => 'required|email',
            "current_password"      => "same_password:$id|required_with:password|nullable",
            "password"              => "required_with:current_password|confirmed|min:6|nullable",
            "password_confirmation" => "same:password|min:6|nullable"
        ];
    }
}
