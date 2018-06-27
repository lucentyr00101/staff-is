<?php

use Faker\Generator as Faker;

$factory->define(App\EmployeePreferableWork::class, function (Faker $faker) {
	return [
		'employee_id' => factory('App\Employee')->create()->id,
		'location' => $faker->state,
	];
});
