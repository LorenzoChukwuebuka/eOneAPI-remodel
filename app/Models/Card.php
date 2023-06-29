<?php

namespace App\Models;

use App\Models\User;
use App\Models\Vendor;
use App\Models\CardType;
use App\Models\AccountType;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Card extends Model
{
    use HasFactory;

    protected $guarded = [];

    protected $hidden = [
        "pin",
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function vendor()
    {
        return $this->belongsTo(Vendor::class);
    }

    public function cardType()
    {
        return $this->belongsTo(CardType::class);
    }

    public function accountType()
    {
        return $this->belongsTo(AccountType::class);
    }
}
