<?php

namespace Database\Seeders;

use App\Models\MontantLibre;
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
            RegistreSeeder::class,
            CommandeSeeder::class,
            DepenseSeeder::class,
            MontantLibre::class,
        
        ]);
    }
}
