<?php

namespace SON\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class ClassStudentRequest extends FormRequest
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
        $class_information = $this->route('class_information');
        return [
            'student_id' => [
                'required',
                'exists:students,id',
                Rule::unique('class_information_student','student_id')
                ->where('class_information_id',$class_information->id)
            ]
        ];
    }
}
