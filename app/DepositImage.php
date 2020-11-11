<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class DepositImage extends Model
{
    protected $table = 'deposit_images';

    protected $fillable = ['deposit_id','image'];

}
