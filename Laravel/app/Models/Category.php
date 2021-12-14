<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    use HasFactory;

    protected $fillable = ['name', 'slug', 'images', 'status'];

    public function event()
    {
        return $this->hasMany(Event::class);
    }

    public function service()
    {
        return $this->hasMany(Service::class);
    }
}
