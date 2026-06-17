<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Tag extends Model
{
    use HasFactory;
    // Zorg dat de naam van de tag invulbaar is
    protected $fillable = ['name'];

    // De omgekeerde relatie: een tag kan bij meerdere auto's horen
    public function cars()
    {
        return $this->belongsToMany(Car::class);
    }
}
