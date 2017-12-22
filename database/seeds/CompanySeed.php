<?php

use Illuminate\Database\Seeder;
use App\Category;
use App\City;

class CompanySeed extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = Faker\Factory::create();
        
        for($i = 0; $i < 60; $i++) {

            App\Company::create([
                'name' => $faker->company,
                'city_id' => $faker->randomElement(City::pluck('id')->toArray()),
                'address' => $faker->address,
                'description' => $faker->text($maxNbChars = 400) ,
                'logo' => '1513238022-Logomakr_3zaNpj.png',
            ]);

        }
        for($i = 0; $i < 60; $i++) {

            DB::table('category_company')->insert([
                'category_id' => rand(1,8),
                'company_id' => $faker->unique()->numberBetween(1, 60)
            ]);

        }
    }
}