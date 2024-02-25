<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Faker\Factory as Faker;
class RegistreSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $faker = Faker::create();

        foreach (range(1, 10) as $index) {
            $commandeId = DB::table('commandes')->inRandomOrder()->first()->id;
            DB::table('registres')->insert([
                'idCommande' => $commandeId,
                'RefCommande'=>'CMD' . time() . $index,
                'RefArticle' => $faker->numberBetween(1000, 9999),
                'nomArticle' => $faker->word,               
                
                'marque'=>$faker->word,
                'stock'=>$faker->numberBetween(1,20),
                'prixHT'=>$faker->randomFloat(2, 1, 100),
                'TVA'=>$faker->numberBetween(1,20),
                'prixTTC'=>$faker->randomFloat(2, 1, 100),
                'MtCommandeTTC'=>$faker->randomFloat(2, 1, 100),
                'quantitéArticle'=>$faker->numberBetween(1,20),
                'QteArticleTotal'=>$faker->numberBetween(1,20),
                'MoyenDePaiement'=>$faker->word,
                'OrigineDeVente'=>$faker->randomElement(['Online', 'In-store']),
                'categorie'=>$faker->word,
                'SousCategorie'=>$faker->word,
                
                // Add other fields
                'idArticle' => $faker->numberBetween(1, 10), // Assuming 10 sous categories
                'idCommande' => $faker->numberBetween(1, 10), 
                'idMontantLibre' => $faker->numberBetween(1, 10), 
                'idBoutique' => $faker->numberBetween(1, 10), 
            ]);
        }
    }
}
