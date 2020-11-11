<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Support extends Model
{
    protected $table = 'supports';

    protected $fillable = ['user_id','ticket_number','subject','status'];

    public function user()
    {
        return $this->belongsTo(User::class,'user_id');
    }

}
