<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Faker\Factory as Faker;

class ArticlesSeeder extends Seeder
{
    public function run()
    {
        $faker = Faker::create();
        $vetements = ['T-shirt', 'Robe', 'Chemise', 'Jupe', 'Veste', 'Pull', 'Short', 'Manteau'];
        foreach (range(1, 20) as $index) {
            $nomArticle = $vetements[array_rand($vetements)];
            DB::table('articles')->insert([
                'reference' => $faker->numberBetween(1000, 9999),
                'nomArticle' => $nomArticle,
                'photo' => $faker->imageUrl($width = 60, $height = 60, 'fashion'),
                'marque' => $faker->words(1, true),
                'stock' => $faker->numberBetween(1, 20),
                'prixHT' => $faker->randomFloat(2, 1, 100),
                'TVA' => '20', 
                'prixTTC' => DB::raw('prixHT * 1.2'), // Calcul du prix TTC en fonction du prix HT
                'slug' => $faker->slug,
                'idSousCategorie' => $faker->numberBetween(1, 10),
            ]);
        }
    }
}
