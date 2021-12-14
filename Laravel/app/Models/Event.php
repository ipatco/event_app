<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Event extends Model
{
    use HasFactory;

    protected $fillable = [
        'title', 'slug', 'description', 'image', 'location', 'price', 'category_id', 'start_date', 'end_date', 'o_name', 'o_phone', 'o_email', 'o_website', 'status', 'user_id'
    ];

    public function category()
    {
        return $this->belongsTo('App\Models\Category');
    }

    public function user()
    {
        return $this->belongsTo('App\Models\User');
    }

    public function bookings()
    {
        return $this->hasMany(Booking::class, 'event_id');
    }
}
