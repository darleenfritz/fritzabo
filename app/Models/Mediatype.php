<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use App\Models\Subscription;

class Mediatype extends Model
{
    use HasFactory;
    //
        public function subscriptions()
    {
        return $this->hasMany(Subscription::class);
    }
}
