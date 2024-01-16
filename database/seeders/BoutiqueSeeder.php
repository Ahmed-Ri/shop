<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Faker\Factory as Faker;
class BoutiqueSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $faker = Faker::create();

        foreach (range(1, 10) as $index) {
            DB::table('boutiques')->insert([
                
                'nom'=> $faker->word,
                'prenom'=> $faker->word,
                'nomBoutique'=> $faker->word,
                'adresse'=> $faker->word,
                'telephone'=>$faker->numberBetween(1,20),
                'mail'=> $faker->email,
                'idRegistre' => $faker->numberBetween(1, 10),
                'idDepense' => $faker->numberBetween(1, 10),
            ]);
        }
    }
}
