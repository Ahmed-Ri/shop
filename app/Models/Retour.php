<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Retour extends Model
{
    use HasFactory;
    protected $fillable = [
        'nomArticle',
        'MontantRetour',
        'categorieRetour',
       
       ];
       public function article()
    {
        return $this->belongsTo(Article::class);
    }
}
