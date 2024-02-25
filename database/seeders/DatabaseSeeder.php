<?php

namespace Database\Seeders;

use App\Models\MontantLibre;
use App\Models\Retour;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    public function run()
    {
        $this->call([
            CategoriesSeeder::class,
            SousCategoriesSeeder::class,
            ArticlesSeeder::class,
            CommandeSeeder::class,
            MontantLibre::class,
            RegistreSeeder::class,
            
            DepenseSeeder::class,
            BoutiqueSeeder::class,
            Retour::class,

        
        ]);
    }
}
