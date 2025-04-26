<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Subscribtion extends Model
{
    protected $table = 'SUBSCRIBTION';
    protected $primaryKey = 'sub_id';
    public $timestamps = false;
    protected $casts = [
        'ua_availability_start_date' => 'datetime',
        'sub_start_date' => 'datetime',
        'sub_end_date' => 'datetime',
    ];
    protected $fillable = [
        'sub_amount',
        'sub_start_date',
        'sub_end_date',
        'sub_number_of_ads',
        'sub_payment_method',
        'sub_card_number',
        'acc_id',
        'pack_id'
    ];

    public function account()
    {
        return $this->belongsTo(Account::class, 'acc_id', 'acc_id');
    }

    public function package()
    {
        return $this->belongsTo(Package::class, 'pack_id', 'pack_id');
    }
}
