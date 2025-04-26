<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class UnitAds extends Model
{
    protected $table = 'UNIT_ADS';
    protected $primaryKey = 'ua_id';
    public $timestamps = false;

    protected $fillable = [
        'ua_size',
        'ua_status',
        'ua_rent_duration',
        'ua_description',
        'ua_rent_fees',
        'ua_availability_start_date',
        'ua_type',
        'ua_address',
        'ua_pets_allowed',
        'ua_smoking_allowed',
        'ua_num_of_roommates',
        'ua_num_of_bedrooms',
        'ua_lease_term',
        'ua_age',
        'ua_added_at',
        'ua_deed_number',
        'acc_id'
    ];

    public function account()
    {
        return $this->belongsTo(Account::class, 'acc_id', 'acc_id');
    }

    public function reviews()
    {
        return $this->hasMany(Review::class, 'ua_id', 'ua_id');
    }

    public function images()
    {
        return $this->hasMany(Image::class, 'ua_id', 'ua_id');
    }

    public function facilities()
    {
        return $this->hasMany(Facilities::class, 'ua_id', 'ua_id');
    }
    public function roommateRequests()
    {
        return $this->hasMany(RoommateRequest::class, 'ua_id', 'ua_id');
    }

    public function likes()
    {
        return $this->hasMany(Like::class, 'ua_id');
    }
    public function views()
    {
        return $this->hasMany(View::class, 'ua_id');
    }

}
