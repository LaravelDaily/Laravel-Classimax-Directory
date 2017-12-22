<?php

$factory->define(App\Company::class, function (Faker\Generator $faker) {
    return [
        "name" => $faker->name,
        "city_id" => factory('App\City')->create(),
        "address" => $faker->name,
        "description" => $faker->name,
    ];
});
