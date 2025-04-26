<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Package extends Model
{
    protected $table = 'PACKAGE';
    protected $primaryKey = 'pack_id';
    public $timestamps = false;

    protected $fillable = [
        'pack_name',
        'pack_fee',
        'pack_privillages',
        'pack_duration',
        'pack_status',
        'acc_id',
    ];

    public function account()
    {
        return $this->belongsTo(Account::class, 'acc_id', 'acc_id');
    }

    public function subscribtions()
    {
        return $this->hasMany(Subscribtion::class, 'pack_id', 'pack_id');
    }
}
