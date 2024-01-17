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

        foreach (range(1, 20) as $index) {
            DB::table('articles')->insert([
                'reference' => $faker->numberBetween(1000, 9999),
                'nomArticle' => $faker->word,
                'photo' =>'public/images/logo.png',
                'marque'=>$faker->word,
                'stock'=>$faker->numberBetween(1,20),
                'prixHT'=>$faker->randomFloat(2, 1, 100),
                'TVA'=>$faker->numberBetween(1,20),
                'prixTTC'=>$faker->randomFloat(2, 1, 100),
                'slug'=> $faker->slug,
                // Add other fields
                'idSousCategorie' => $faker->numberBetween(1, 10), // Assuming 10 sous categories
            ]);
        }
    }
}
