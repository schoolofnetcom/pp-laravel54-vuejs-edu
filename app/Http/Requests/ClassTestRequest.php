<?php

namespace SON\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;
use SON\Models\ClassTeaching;

class ClassTestRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        $classTeaching = $this->route('class_teaching');
        $result = ClassTeaching
            ::where('teacher_id',\Auth::user()->userable->id)
            ->find($classTeaching->id);

        return $result != null;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'name' => 'required|max:255',
            'date_start' => 'required|date_format:Y-m-d\TH:i',
            'date_end' => 'required|date_format:Y-m-d\TH:i',
            'questions' => 'required|array',
            'questions.*.question' => 'required',
            'questions.*.point' => 'required|numeric',
            'questions.*.choices' => 'required|array|choice_true',
            'questions.*.choices.*.choice' => 'required',
        ];
    }
}
