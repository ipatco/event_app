<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Booking extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id', 'room_id', 'start_date', 'end_date', 'price', 'status'
    ];

    //relationship with user
    public function user()
    {
        return $this->belongsTo('App\Models\User');
    }
    public function vendor()
    {
        return $this->belongsTo('App\Models\User');
    }

    public function event()
    {
        return $this->belongsTo('App\Models\Event', 'event_id');
    }

    public function service()
    {
        return $this->belongsTo('App\Models\Service', 'service_id');
    }

    public function transaction()
    {
        return $this->hasOne('App\Models\Transaction');
    }
}
