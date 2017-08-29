<?php

namespace SON\Models;

use Illuminate\Database\Eloquent\Model;

class Student extends Model
{
    public function user(){
        return $this->morphOne(User::class,'userable');
    }

    public function classInformations(){
        return $this->belongsToMany(ClassInformation::class);
    }

    public function toArray()
    {
        $data = parent::toArray();
        $this->user->makeHidden('userable_type','userable_id');
        $data['user'] = $this->user;
        return $data;
    }
}
