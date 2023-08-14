<?php

namespace App\Models;

use App\Models\Client;
use App\Models\User;
use App\Models\VendorBankAccount;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

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

    public function vendorAccount()
    {
        return $this->hasMany(VendorBankAccount::class);
    }
}
