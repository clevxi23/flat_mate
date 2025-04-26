<?php


namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class View extends Model
{
    protected $table = 'View';
    protected $primaryKey = 'view_id';
    public $timestamps = false;

    protected $fillable = [
        'acc_id',
        'ua_id',
        'view_ip_address',
        'view_dateTime',
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
