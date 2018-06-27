<?php

use Faker\Generator as Faker;

$factory->define(App\EmployeeLanguage::class, function (Faker $faker) {
	return [
		'employee_id' => factory('App\Employee')->create()->id,
		'language' => $faker->lastname,
		'proficiency' => $faker->lastname,
	];
});
