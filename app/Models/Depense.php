<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Depense extends Model
{
    use HasFactory;
    protected $fillable = [
        'nomDepense',
        'MtDepense',
        'CategorieDepense'
       ];
       public function boutique()
    {
        return $this->belongsTo(Boutique::class);
    }
}
