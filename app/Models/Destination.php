<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Destination extends Model
{
    protected $table = 'destinations';

    // Allow all attributes
    use HasFactory;

    protected $fillable = [
        'name',
        'location',
        'description',
        'category',
        'image_url',
        'latitude',
        'longitude',
        'created_by'
    ];
    
    protected $guarded = [];

    // app/Models/Destination.php
    public function reviews()
    {
        return $this->hasMany(Review::class);
    }

    // app/Models/Destination.php
    public function updateAverageRating()
    {
        $avg = $this->reviews()->avg('rating');
        $this->average_rating = $avg ?? 0;
        $this->save();
    }

    // ... existing code ...
    /**
     * Check if a given user has favorited this destination.
     */
    public function isFavoritedBy(User $user): bool
    {
        return $this->favorites()->where('user_id', $user->id)->exists();
    }

    public function favorites()
    {
        return $this->hasMany(Favorite::class);
    }

    public function hotels()
    {
        return $this->hasMany(Hotel::class);
    }

}