<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Social extends Model
{
    protected  $table = 'socials';

    protected $fillable = ['name','code','link'];

}
