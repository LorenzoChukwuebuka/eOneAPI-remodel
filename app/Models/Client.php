<?php

namespace App\Models;

use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class Client extends Authenticatable
{

    use Notifiable, SoftDeletes, HasApiTokens;

    protected $guarded = [];

    public function getAuthPassword()
    {
        return $this->pin;
    }

}
