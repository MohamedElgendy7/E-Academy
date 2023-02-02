<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StudentRequest extends FormRequest
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
            'name' => 'required_without:id',
            'number' => 'required_without:id|numeric|min:12',
            'group_id' => 'required',
            'main_category_id' => 'required',
            'grade_id' => 'required',
        ];
    }

    public function messages()
    {
        return [
            'required' => 'هذا الحقل مطلوب',
            'name.required_without' => 'هذا الحقل مطلوب',
            'number.required_without' => 'هذا الحقل مطلوب',
            'number.numeric' => 'ارقام فقط',
            'number.max' => 'لا تتخطي ال 11 رقم ',
            'number.min' => ' اقل من المطلوب   ',
        ];
    }
}
