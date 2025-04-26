<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Application extends Model
{
    protected $table = 'APPLICATION';
    protected $primaryKey = 'app_id';
    public $timestamps = false;

    protected $fillable = [
        'app_status',
        'acc_id',
        'roommate_req_id'
    ];

    // ينتمي لحساب معين (الشخص الذي قدم الطلب)
    public function account()
    {
        return $this->belongsTo(Account::class, 'acc_id', 'acc_id');
    }

    // ينتمي لطلب رفيق السكن
    public function roommateRequest()
    {
        return $this->belongsTo(RoommateRequest::class, 'roommate_req_id', 'roommate_req_id');
    }
}
