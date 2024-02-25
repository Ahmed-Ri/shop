<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SousCategorie extends Model
{
    use HasFactory;
    protected $fillable = [
        'nomSousCategorie',
        'slug'
        
       ];
       public function categorie()
    {
        return $this->belongsTo(Categorie::class,'idCategorie','id');
    }
    public function article()
    {
        return $this->hasMany(Article::class);
    }
}
