<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Message extends Model
{
    protected $table = 'MESSAGES';
    protected $primaryKey = 'ma_id';
    public $timestamps = false;

    protected $fillable = [
        'ma_title',
        'ma_type',
        'ma_date_time',
        'sender_id',
        'receiver_id',
        'ma_content',
        'is_read',
    ];

    public function sender()
    {
        return $this->belongsTo(Account::class, 'sender_id', 'acc_id');
    }

    public function receiver()
    {
        return $this->belongsTo(Account::class, 'receiver_id', 'acc_id');
    }
}
