<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CreateUserRequest extends FormRequest
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
            'name' => ['required', 'string'],
            'email' => ['required', 'email', 'max:50'],
            'password' => ['required', 'same:confirmPwd', 'min:8', 'max:16', 'regex:/^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)[a-zA-Z\d]*$/'],
            'confirmPwd' => ['required', 'min:8', 'max:16', 'regex:/^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)[a-zA-Z\d]*$/'],
            'type' => ['required'],
            'phone' => ['nullable'],
            'dob' => ['nullable'],
            'address' => ['nullable'],
            'profile' => ['required', 'image', 'mimes:jpg,png,jpeg,gif,svg', 'max:2048'],
        ];
    }

    /**
     * Custom Message for Validation
     *
     * @return array
     */
    public function messages()
    {
        return [
            'password.required' => __("message.E0001"),
            'password.same' => __("message.E0006"),            
            'confirmPwd.regex' => __("message.E0016"),
            'confirmPwd.required' => __("message.E0004"),
            'confirmPwd.min' => __("message.E0010"),
            'confirmPwd.max' => __("message.E0014"),
            'confirmPwd.regex' => __("message.E0019"),
        ];
    }
}
