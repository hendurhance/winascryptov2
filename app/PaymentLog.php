<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class PaymentLog extends Model
{
    protected $table = 'payment_logs';

    protected $fillable = ['amount','member_id','custom','usd','payment_type','net_amount','charge','btc_amo','btc_acc','try','status'];

    public function payment()
    {
        return $this->belongsTo(PaymentMethod::class,'payment_type');
    }

    public function user()
    {
        return $this->belongsTo(User::class,'member_id','id');
    }
}
