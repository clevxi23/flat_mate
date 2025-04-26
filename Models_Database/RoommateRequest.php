<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class RoommateRequest extends Model
{
    protected $table = 'ROOMMATEREQUEST';
    protected $primaryKey = 'roommate_req_id';
    public $timestamps = false;

    protected $fillable = [
        'ua_id',
        'req_status',
        'acc_id',
        'roommate_req_des',
        'roommate_req_gender',
        'roommate_req_age',
        'roommate_req_emp_status',
        'roommate_req_smoking',
        'roommate_req_child',
        'roommate_req_pets_ref',
        'owner_action',
        'roommate_req_num_of_roommate'
    ];


     public function account()
     {
         return $this->belongsTo(Account::class, 'acc_id', 'acc_id');
     }
     public function unitAd()
     {
         return $this->belongsTo( UnitAds::class, 'ua_id', 'ua_id');
     }

    public function applications()
    {
        return $this->hasMany(Application::class, 'roommate_req_id', 'roommate_req_id');
    }
}
