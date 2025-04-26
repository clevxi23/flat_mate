<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Image extends Model
{
    protected $table = 'IMAGES';
    protected $primaryKey = 'image_id';
    public $timestamps = false;

    protected $fillable = [
        'image_url',
        'ua_id'
    ];

    // تنتمي لوحدة سكنية محددة
    public function unitAds()
    {
        return $this->belongsTo(UnitAds::class, 'ua_id', 'ua_id');
    }
}
