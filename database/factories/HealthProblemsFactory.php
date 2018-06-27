<?php

use Faker\Generator as Faker;

$factory->define(App\EmployeeHealthProblem::class, function (Faker $faker) {
	return [
		'employee_id' => factory('App\Employee')->create()->id,
		'health_problem' => $faker->realText($maxNbChars = 10, $indexSize = 2),
	];
});
