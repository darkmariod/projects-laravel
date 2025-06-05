<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use \Illuminate\Database\Eloquent\Factories\HasFactory;


class Protein extends Model
{   
    use HasFactory;
    
    protected $fillable = [
        'name',
    ];

    //Relación uno a muchos
    public function categories()
    {
        return $this->hasMany(Category::class);
    }
}
