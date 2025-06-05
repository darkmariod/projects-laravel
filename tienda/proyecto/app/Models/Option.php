<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Option extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'type',
    ];

    //Relación uno a muchos
    public function products()
    {
        return $this->belongsToMany(Product::class)
            ->withPivot("value")
            ->withTimestamps();
    }

    // Relación uno a muchos
    public function feautres()
    {
        return $this->hasMany(Feature::class);
    }   
}
