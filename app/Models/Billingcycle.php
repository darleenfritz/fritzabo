<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use App\Models\Subscription;

class Billingcycle extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'interval_in_days'
    ];

    public function subscriptions()
    {
        return $this->hasMany(Subscription::class);
    }
}
