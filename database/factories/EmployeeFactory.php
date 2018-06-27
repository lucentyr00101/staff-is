<?php

use Faker\Generator as Faker;

$factory->define(App\Employee::class, function (Faker $faker) {
	return [
		'user_id' => factory('App\User')->create()->id,
		'fullname' => $faker->name,
		'age' => $faker->randomDigitNotNull,
		'gender' => $faker->state,
		'civil_status' => $faker->state,
		'number_of_children' => $faker->randomDigitNotNull,
		'nationality' => $faker->countryCode,
		'hasDriverLicense' => 0,
		'hasCar' => 0,
		'address' => $faker->address,
		'summary' => $faker->realText($maxNbChars = 200, $indexSize = 2),
		'email_confirmation' => $faker->safeEmail,
		'emergency_contact_number' => $faker->randomDigitNotNull,
		'status' => 1,
		'login_count' => 1,
	];
});
