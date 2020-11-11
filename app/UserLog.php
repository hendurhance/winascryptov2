<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class UserLog extends Model
{
    protected $table = 'user_logs';

    protected $fillable = ['user_id','amount','transaction_id','charge','amount_type','description','post_bal'];

    public function user()
    {
        return $this->belongsTo(User::class,'user_id');
    }

}
