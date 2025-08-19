<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Hotel extends Model
{
    use HasFactory;

    protected $fillable = [
        'destination_id',
        'name',
        'price',
        'rating',
        'details',
        'image_url',
    ];

    public function destination()
    {
        return $this->belongsTo(Destination::class);
    }

    
}
