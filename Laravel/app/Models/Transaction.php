<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Transaction extends Model
{
    use HasFactory;

    protected $fillable = [];

    public function user()
    {
        return $this->belongsTo('App\Models\User');
    }

    public function bookings()
    {
        return $this->belongsTo('App\Models\Booking');
    }
}
