<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ExaminationChild extends Model
{
    protected $guarded = ['id'];

    public function child()
    {
        return $this->belongsTo(Child::class, 'child_id');
    }
}
