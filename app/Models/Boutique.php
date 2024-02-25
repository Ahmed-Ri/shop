<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Boutique extends Model
{
    use HasFactory;
    protected $fillable = [
        'nom',
        'prenom',
        'nomBoutique',
        'adresse',
        'telephone',
        'mail',

       ];
       public function registre()
       {
           return $this->hasMany(Registre::class);
       }
       public function depense()
       {
           return $this->hasMany(Depense::class);
       }
}
