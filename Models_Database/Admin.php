<?php

namespace App\Models;

use App\Traits\Translatable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\User as Authenticatable;

class Admin extends Authenticatable
{
    use Translatable;

    protected $fillable = [
        'name',
        'email',
        'email',
        'password',
    ];
}
