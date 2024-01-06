<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Faker\Factory as Faker;
class CommandeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $faker = Faker::create();

        foreach (range(1, 10) as $index) {
            DB::table('commandes')->insert([
                'nomArticle' => $faker->word,
                'MtCommandeTTC'=>$faker->randomFloat(2, 1, 100),
                'QteArticleTotal'=>$faker->numberBetween(1,20),            
                           
                
               
            ]);
        }
    }
}
