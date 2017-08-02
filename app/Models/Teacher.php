<?php

namespace SON\Models;

use Illuminate\Database\Eloquent\Model;

class Teacher extends Model
{
    public function user(){
      return $this->morphOne(User::class,'userable');
    }

    public function toArray()
    {
        $data = parent::toArray();
        $this->user->makeHidden('userable_type','userable_id');
        $data['user'] = $this->user;
        return $data;
    }
}
