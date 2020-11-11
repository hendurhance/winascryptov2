<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class RepeatLog extends Model
{
    protected $table = 'repeat_logs';

    protected $guarded = [''];

    public function user()
    {
        return $this->belongsTo(User::class,'user_id');
    }
    public function Invest()
    {
        return $this->belongsTo(Investment::class,'investment_id');
    }


}
