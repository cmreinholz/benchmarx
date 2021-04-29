<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Question extends Model
{
    public function response()
    {
        return $this->hasMany(Response::class);
    }

    protected $fillable = [
        'question', 'responses', 'type', 'dependent_id', 'dependent_response', 'active',
    ];
}
