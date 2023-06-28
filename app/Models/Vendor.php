<?php

namespace App\Models;

use App\Models\User;
use App\Models\Client;
use Laravel\Sanctum\HasApiTokens;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Foundation\Auth\User as Authenticatable;

class Vendor extends Authenticatable
{
    use Notifiable, SoftDeletes, HasApiTokens;

    protected $guarded = [];

    protected $hidden = [
        "password",
    ];

    public function users()
    {
        return $this->hasMany(User::class);
    }

    public function client()
    {
        return $this->belongsTo(Client::class);
    }
}
