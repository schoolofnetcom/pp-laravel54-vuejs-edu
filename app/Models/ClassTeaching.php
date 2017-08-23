<?php

namespace SON\Models;

use Illuminate\Database\Eloquent\Model;

class ClassTeaching extends Model
{
    public $timestamps = false;

    protected $fillable = [
        'subject_id',
        'class_information_id',
        'teacher_id'
    ];

    public function classTests(){
        return $this->hasMany(ClassTest::class);
    }

    public function subject(){
        return $this->belongsTo(Subject::class);
    }

    public function classInformation(){
        return $this->belongsTo(ClassInformation::class);
    }

    public function teacher(){
        return $this->belongsTo(Teacher::class);
    }

    public function toArray()
    {
        $data = parent::toArray();
        $data['teacher'] = $this->teacher;
        $data['subject'] = $this->subject;
        $data['class_information'] = $this->classInformation;
        return $data;
    }

}
