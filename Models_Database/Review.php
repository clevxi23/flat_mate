<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Review extends Model
{
    protected $table = 'REVIEW';
    protected $primaryKey = 'review_id';
    public $timestamps = false;

    protected $fillable = [
        'review_subject',
        'review_comment',
        'review_rate',
        'review_account',
        'review_dateTime',
        'ua_id',
        'acc_id'
    ];

    public function unitAds()
    {
        return $this->belongsTo(UnitAds::class, 'ua_id', 'ua_id');
    }

    public function account()
    {
        return $this->belongsTo(Account::class, 'acc_id', 'acc_id');
    }
}
