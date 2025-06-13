<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Mediatype;

class Subscription extends Model
{
    /** @use HasFactory<\Database\Factories\SubscriptionFactory> */
    use HasFactory;

    protected $fillable = [
        'name',
        'contact',
        'price',
        'subscribed_at',
        'mediatype_id'
    ];

    public function mediatype()
    {
        return $this->belongsTo(Mediatype::class);
    }

}
