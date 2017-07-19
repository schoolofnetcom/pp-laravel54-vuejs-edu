<?php

namespace SON\Models;

use Illuminate\Database\Eloquent\Model;

class UserProfile extends Model
{
    protected $fillable = [
        'address',
        'cep',
        'number',
        'complement',
        'city',
        'neighborhood',
        'state'
    ];
}
