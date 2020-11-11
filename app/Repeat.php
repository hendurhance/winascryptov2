<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Repeat extends Model
{
    protected $table = 'repeats';

    protected $guarded = [''];

    public function invest()
    {
        return $this->belongsTo(Investment::class,'investment_id');
    }

}
