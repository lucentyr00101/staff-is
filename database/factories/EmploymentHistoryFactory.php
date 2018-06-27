<?php

use Faker\Generator as Faker;

$factory->define(App\EmploymentHistory::class, function (Faker $faker) {
	return [
		'employee_id' => factory('App\Employee')->create()->id,
		'job_title' => $faker->lastname,
		'job_description' => $faker->realText($maxNbChars = 20, $indexSize = 2),
		'job_duration' => $faker->state,
		'company' => $faker->state,
		'salary' => $faker->randomDigitNotNull,
	];
});
