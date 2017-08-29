<?php

namespace SON\Http\Requests;

use Carbon\Carbon;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;
use SON\Models\ClassTest;

class StudentClassTestRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        $classTest = $this->route('class_test');
        $result = ClassTest
            ::byStudent(\Auth::user()->userable->id)
            ->find($classTest->id);

        return $result != null;
    }

    protected function validationData()
    {
        $classTest = $this->route('class_test');
        $data = [
            'class_test_id' => $classTest->id,
            'date_start' => $classTest->date_start,
            'date_end' => $classTest->date_end,
            'date' => (new Carbon())->format(\DateTime::ISO8601)
        ];
        /**
         * choices => [question_id => question_choice_id]
         */
        $choices = $this->get('choices');
        $data['choices'] = $choices;
        if(is_array($choices)){
            $data['choices'] = [];
            foreach ($choices as $questionId => $choiceId){
                array_push($data['choices'],[
                    'question_id' => $questionId,
                    'question_choice_id' => $choiceId
                ]);
            }
            $this->merge($data);
        }
        return $data;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        $classTest = $this->route('class_test');
        return [
            'class_test_id' => [
                Rule::unique('student_class_tests')
                ->where('student_id',\Auth::user()->userable->id)
            ],
            //'date' => 'after_or_equal:date_start|before_or_equal:date_end',
            'date' => 'before_or_equal:date_end',
            'choices' => 'required|array',
            'choices.*.question_id' => [
                'required',
                Rule::exists('questions','id')
                    ->where('class_test_id',$classTest->id)
            ],
            'choices.*.question_choice_id' => 'required|choice_from_question'
        ];
    }
}
