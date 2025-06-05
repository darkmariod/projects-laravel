<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Feature extends Model
{
    use HasFactory;
    
    protected $fillable = [
        'value',
        'description',
        'option_id',
    ];
    
    // Relación uno a muchos inversa
    public function option()
    {
        return $this->belongsTo(Option::class);
    }

    // Relación muchos a muchos
    public function variant()
    {
        return $this->belongsTo(Variants::class)
                    ->withTimestamps();
    }
    
}
