<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Faker\Factory as Faker;
class MontantLibreSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $faker = Faker::create();

        foreach (range(1, 10) as $index) {
            
            DB::table('montant_libres')->insert([
                
                'nomArticle' => $faker->word,             
                'prixTTC'=>$faker->randomFloat(2, 1, 100),           
                'OrigineDeVente'=>$faker->randomElement(['Online', 'In-store']),
                'categorie'=>$faker->word,
                
            ]);
        }
    }
}
