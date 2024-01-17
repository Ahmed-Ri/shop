<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;

use Illuminate\Support\Facades\DB;
use Faker\Factory as Faker;
use Illuminate\Database\Seeder;

class DepenseSeeder extends Seeder
{
    
    public function run(): void
    {
        $faker = Faker::create();

        foreach (range(1, 10) as $index) {
            DB::table('depenses')->insert([
                'nomDepense' => $faker->word,
                'MtDepense'=>$faker->randomFloat(2, 1, 100),
                'CategorieDepense'=>$faker->word,  
                         
                'idBoutique' => $faker->numberBetween(1, 10),          
                
               
            ]);
        }
    }
}
