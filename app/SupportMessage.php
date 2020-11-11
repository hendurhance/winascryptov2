<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class SupportMessage extends Model
{
    protected $table = 'support_messages';

    protected $fillable = ['support_id','type','ticket_number','message'];

    public function support()
    {
        return $this->belongsTo(Support::class,'support_id');
    }

}
