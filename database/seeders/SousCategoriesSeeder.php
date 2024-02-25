<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Faker\Factory as Faker;

class SousCategoriesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run()
    {
        $faker = Faker::create();

        foreach (range(1, 10) as $index) {
            DB::table('sous_categories')->insert([
                'nomSousCategorie' => $faker->word,
                'slug' => $faker->slug,
                'idCategorie' => $faker->numberBetween(1, 10), // Assuming 10 categories
            ]);
            // $categorieId = DB::table('categories')->first()->id;
            // 'categorie_id' => $categorieId,
        }
    }
}
