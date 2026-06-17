<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\User;
use App\Models\Tag;

class Car extends Model
{
    use HasFactory;
    protected $fillable = [
        'user_id',
        'license_plate',
        'brand',
        'model',
        'price',
        'mileage',
        'seats',
        'doors',
        'production_year',
        'weight',
        'color',
        'fuel_type',
        'horsepower',
        'catalogusprijs',
        'vervaldatum_apk',
        'aantal_wielen',
        'aantal_cilinders',
        'cilinderinhoud',
        'massa_ledig_voertuig',
        'massa_rijklaar',
        'image',
        'sold_at',
        'views',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function tags()
    {
        return $this->belongsToMany(Tag::class);
    }
}
