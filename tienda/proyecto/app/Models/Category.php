<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use \Illuminate\Database\Eloquent\Factories\HasFactory;

class Category extends Model
{

    use HasFactory;

    protected $fillable = [
        'name',
        'protein_id',
    ];
    
    // Relación uno a muchos inversa
    public function protein()
    {
        return $this->belongsTo(Protein::class);
    }

    // Relación uno a muchos
    public function subcategoriers()
    {
        return $this->hasMany(Subcategory::class);
    }
}
