<?php

namespace SON\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

class ClassTest extends Model
{
    protected $fillable = [
        'date_start',
        'date_end',
        'name',
        'class_teaching_id'
    ];

    public function classTeaching()
    {
        return $this->belongsTo(ClassTeaching::class);
    }

    public function questions()
    {
        return $this->hasMany(Question::class);
    }

    public function scopeByTeacher($query, $teacherId)
    {
        return $query->whereHas('classTeaching', function ($query) use ($teacherId) {
            $query->where('teacher_id', $teacherId);
        });
    }

    public function scopeByStudent($query, $studentId)
    {
        return $query->whereHas('classTeaching', function ($query) use ($studentId) {
            $query->whereHas('classInformation', function ($query) use ($studentId) {
                $query->whereHas('students', function ($query) use ($studentId) {
                    $query->where('student_id',$studentId);
                });
            });
        });
    }

    protected function deleteQuestions()
    {
        foreach ($this->questions()->get() as $question) {
            $question->choices()->delete();
            $question->delete();
        }
    }

    protected static function createQuestion($question)
    {
        /** @var Question $newQuestion */
        $newQuestion = Question::create($question);
        foreach ($question['choices'] as $choice) {
            $choice['true'] = $choice['true'] !== false ? true : false;
            $newQuestion->choices()->create($choice);
        }
    }

    public static function createFully(array $data)
    {
        $classTest = self::create($data);
        foreach ($data['questions'] as $question) {
            self::createQuestion($question + ['class_test_id' => $classTest->id]);
        }
        return $classTest;
    }

    public function updateFully(array $data)
    {
        $this->update($data);
        $this->deleteQuestions();
        foreach ($data['questions'] as $question) {
            self::createQuestion($question + ['class_test_id' => $this->id]);
        }
        return $this;
    }

    public function deleteFully()
    {
        $this->deleteQuestions();
        $this->delete();
    }

    public static function greatherDateEnd30Minutes($dateEnd){
        $dateEnd = (new Carbon($dateEnd))->addMinutes(30);
        return (new Carbon())->greaterThanOrEqualTo($dateEnd);
    }

    public function toArray()
    {
        $data = parent::toArray();
        $data['date_start'] = (new Carbon($this->date_start))->format('Y-m-d\TH:i');
        $data['date_end'] = (new Carbon($this->date_end))->format('Y-m-d\TH:i');
        $data['total_questions'] = $this->questions()->getQuery()->count();
        $data['total_points'] = $this->questions()->getQuery()->sum('point');
        //$data['questions'] = $this->questions;
        return $data;
    }

}
