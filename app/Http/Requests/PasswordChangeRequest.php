<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class PasswordChangeRequest extends FormRequest
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
            'currentPwd' => ['required', 'min:8', 'max:16', 'regex:/^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)[a-zA-Z\d]*$/'],
            'newPwd' => ['required', 'same:newConfirmPwd', 'min:8', 'max:16', 'regex:/^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)[a-zA-Z\d]*$/'],
            'newConfirmPwd' => ['required', 'min:8', 'max:16', 'regex:/^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)[a-zA-Z\d]*$/'],
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
            'currentPwd.required' => __("message.E0002"),
            'currentPwd.min' => __("message.E0008"),
            'currentPwd.max' => __("message.E0012"),
            'currentPwd.regex' => __("message.E0017"),
            'newPwd.required' => __("message.E0003"),
            'newPwd.min' => __("message.E0009"),
            'newPwd.max' => __("message.E0013"),
            'newPwd.same' => __("message.E0007"),
            'newPwd.regex' => __("message.E0018"),
            'newConfirmPwd.required' => __("message.E0005"),            
            'newConfirmPwd.min' => __("message.E0011"),
            'newConfirmPwd.max' => __("message.E0015"),
            'newConfirmPwd.regex' => __("message.E0020"),
        ];
    }
}
