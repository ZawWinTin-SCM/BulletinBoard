<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class PostUploadRequest extends FormRequest
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
            'postFile' => ['required', 'mimes:csv', 'min:1']
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
            'postFile.min' => __("message.E0021"),
        ];
    }
}
