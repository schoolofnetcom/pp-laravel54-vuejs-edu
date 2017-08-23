<?php

/*
|--------------------------------------------------------------------------
| Model Factories
|--------------------------------------------------------------------------
|
| Here you may define all of your model factories. Model factories give
| you a convenient way to create models for testing and seeding your
| database. Just tell the factory how a default model should look.
|
*/

/** @var \Illuminate\Database\Eloquent\Factory $factory */
$factory->define(\SON\Models\User::class, function (Faker\Generator $faker) {
    static $password;

    return [
        'name' => $faker->name,
        'email' => $faker->unique()->safeEmail,
        'password' => $password ?: $password = bcrypt('secret'),
        'remember_token' => str_random(10),
        'enrolment' => str_random(6)
    ];
});

$factory->define(\SON\Models\UserProfile::class, function (Faker\Generator $faker) {

    return [
        'address' => $faker->address,
        'cep' => function() use($faker){
            $cep = preg_replace('/[^0-9]/','',$faker->postcode());
            return $cep;
        },
        'number' => rand(1,100),
        'complement' => rand(1,10)%2==0?null:$faker->sentence,
        'city' => $faker->city,
        'neighborhood' => $faker->city,
        'state' => collect(\SON\Models\State::$states)->random(),
    ];
});

$factory->define(\SON\Models\Subject::class, function (Faker\Generator $faker) {

    return [
        'name' => $faker->word,
    ];
});


$factory->define(\SON\Models\ClassInformation::class, function (Faker\Generator $faker) {

    return [
        'date_start' => $faker->date(),
        'date_end' => $faker->date(),
        'cycle' => rand(1,8),
        'subdivision' => rand(1,16),
        'semester' => rand(1,2),
        'year' => rand(2017,2030),
    ];
});

$factory->define(\SON\Models\ClassTest::class, function (Faker\Generator $faker) {

    return [
        'date_start' => $faker->dateTimeBetween('now','+1 hour'),
        'date_end' => $faker->dateTimeBetween('now','+1 hour'),
        'name' => $faker->sentence(3),
    ];
});

$factory->define(\SON\Models\Question::class, function (Faker\Generator $faker) {

    return [
        'question' => "{$faker->sentence(6)}?",
        'point' => $faker->randomFloat(2,1,3)
    ];
});


$factory->define(\SON\Models\QuestionChoice::class, function (Faker\Generator $faker) {

    return [
        'choice' => $faker->sentence(6)
    ];
});
