<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Movie extends Model {
    use HasFactory;

    protected $fillable = ['title', 'description', 'duration', 'slider_image', 'poster_image', 'showtimes'];

    protected $casts = [
        'showtimes' => 'array', // Convierte automáticamente el JSON en array
    ];

    // Relación con la tabla seats
    public function seats() {
        return $this->hasMany(Seat::class, 'movie_id');
    }
}
