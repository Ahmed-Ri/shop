<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Article extends Model
{
    use HasFactory;

    protected $fillable = [
        'reference',
        'nomArticle',     
        'photo',
        'marque',
        'stock',
        'prixHT',
        'TVA',
        'prixTTC',
        'slug'


    ];
    public function sousCategorie()
    {
        return $this->belongsTo(SousCategorie::class, 'idSousCategorie', 'id');
    }
    public function registre()
    {
        return $this->hasMany(Registre::class);
    }
    public function retour()
    {
        return $this->hasMany(Retour::class);
    }
    public function getprix()
    {
        $prixTTC = $this->prixTTC;
        return number_format($prixTTC, 2, ',', '') . ' €';
    }
}
