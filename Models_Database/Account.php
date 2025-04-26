<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;

class Account extends Authenticatable
{
    protected $table = 'ACCOUNT';

    protected $primaryKey = 'acc_id';

    public $timestamps = false;

    protected $fillable = [
        'acc_name',
        'acc_email',
        'acc_password',
        'acc_phone',
        'acc_gender',
        'acc_address',
        'acc_type',
        'acc_point',
        'acc_total_count',
        'acc_age',
        'acc_smoking',
        'acc_status',
    ];


    public function subscriptions()
    {
        return $this->hasMany(Subscribtion::class, 'acc_id', 'acc_id');
    }

    public function unitAds()
    {
        return $this->hasMany(UnitAds::class, 'acc_id', 'acc_id');
    }

    public function reviews()
    {
        return $this->hasMany(Review::class, 'acc_id', 'acc_id');
    }

    public function applications()
    {
        return $this->hasMany(Application::class, 'acc_id', 'acc_id');
    }

    public function sentMessages()
    {
        return $this->hasMany(Message::class, 'sender_id', 'acc_id');
    }

    public function receivedMessages()
    {
        return $this->hasMany(Message::class, 'receiver_id', 'acc_id');
    }
}
