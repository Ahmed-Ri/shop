<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Registre extends Model
{
    use HasFactory;
    protected $fillable = [
        'reference',
        'nomArticle',       
        'image',
        'marque',
        'stock',
        'prixHT',
        'TVA',
        'prixTTC',
        'MtCommandeTTC',
        'quantitéArticle',
        'QteArticleTotal',
        'MoyenDePaiement',
        'OrigineDeVente',
        'categorie',
        'SousCategorie'

       ];
       public function article()
    {
        return $this->belongsTo(Article::class);
    }
    public function montantLibre()
    {
        return $this->belongsTo(MontantLibre::class);
    }
    public function commande()
    {
        return $this->belongsTo(Commande::class);
    }
    public function boutique()
    {
        return $this->belongsTo(Boutique::class);
    }
    
}
