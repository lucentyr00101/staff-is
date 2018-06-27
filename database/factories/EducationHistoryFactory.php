<?php

use Faker\Generator as Faker;

$factory->define(App\EmployeeEducationHistory::class, function (Faker $faker) {
	return [
		'employee_id' => factory('App\Employee')->create()->id,
		'school_name' => $faker->name,
		'year_graduated' => $faker->year($max = 'now'),
		'highest_degree_attained' => $faker->year($max = 'now'),
		'gpa' => $faker->randomDigitNotNull,
	];
});
