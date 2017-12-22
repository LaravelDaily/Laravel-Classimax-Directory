<?php

use Illuminate\Database\Seeder;

class CategorySeed extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $items = [
            
            ['id' => 1, 'name' => 'Restaurant', 'icon' => 'fa fa-cutlery'],
            ['id' => 2, 'name' => 'Barber', 'icon' => 'fa fa-scissors'],
            ['id' => 3, 'name' => 'IT', 'icon' => 'fa fa-laptop'],
            ['id' => 4, 'name' => 'Car repair', 'icon' => 'fa fa-wrench'],
            ['id' => 5, 'name' => 'Shopping center', 'icon' => 'fa fa-shopping-bag'],
            ['id' => 6, 'name' => 'Bar', 'icon' => 'fa fa-glass'],
            ['id' => 7, 'name' => 'Lawyer', 'icon' => 'fa fa-briefcase'],
            ['id' => 8, 'name' => 'Accommodation', 'icon' => 'fa fa-bed'],

        ];

        foreach ($items as $item) {
            \App\Category::create($item);
        }
    }
}