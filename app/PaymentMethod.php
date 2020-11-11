<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class PaymentMethod extends Model
{
    protected $table = 'payment_methods';

    protected $fillable = [
        'id',
        'name',
        'image',
        'minamo',
        'maxamo',
        'val1',
        'rate',
        'val2',
        'status',
        'fix',
        'percent',
        'currency',
    ];

    public function deposit()
    {
        return $this->hasMany('App\Deposit','id','payment_type');
    }
}
