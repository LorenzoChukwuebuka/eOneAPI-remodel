<?php

namespace App\Models;

use App\Models\Client;
use App\Models\Vendor;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class Client extends Authenticatable
{

    use Notifiable, SoftDeletes, HasApiTokens;

    protected $guarded = [];

    protected $hidden = [
        'pin',
        // Other attributes to hide if needed
    ];

    public function getAuthPassword()
    {
        return $this->pin;
    }

    public function vendors()
    {
        return $this->hasMany(Vendor::class);
    }

}
