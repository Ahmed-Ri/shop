<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MontantLibre extends Model
{
    use HasFactory;
    protected $fillable = [
        'nomArticle',      
        'prixTTC',      
        'OrigineDeVente',
        'categorie'
       ];
    
    public function registre()
    {
        return $this->hasMany(Registre::class);
    }
}
