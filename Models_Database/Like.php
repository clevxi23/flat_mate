<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Like extends Model
{
    protected $table = 'Like';
    protected $primaryKey = 'like_id';
    public $timestamps = false;

    protected $fillable = [
        'ua_id',
        'acc_id',
        'like_dateTime',
    ];

    public function account()
    {
        return $this->belongsTo(Account::class, 'acc_id');
    }

    public function unitAd()
    {
        return $this->belongsTo(UnitAds::class, 'ua_id');
    }
}
