<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Facilities extends Model
{
    protected $table = 'FACILITIES';
    protected $primaryKey = 'fac_id';
    public $timestamps = false;

    protected $fillable = [
        'fac_title',
        'fac_description',
        'ua_id'
    ];

    // تنتمي لوحدة سكنية محددة
    public function unitAds()
    {
        return $this->belongsTo(UnitAds::class, 'ua_id', 'ua_id');
    }
}
