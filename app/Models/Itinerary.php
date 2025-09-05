<?php


namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Itinerary extends Model
{
    use HasFactory;

    protected $fillable = ['user_id', 'title', 'start_date', 'end_date'];

    protected $casts = [
        'start_date' => 'date',
        'end_date'   => 'date',
    ];
    public function days()
    {
        return $this->hasMany(ItineraryDay::class)->orderBy('day_number');
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
