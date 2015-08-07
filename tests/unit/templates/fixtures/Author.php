<?php
use Faker\Generator;
/**
 * @var Generator   $faker
 * @var integer     $index
 */
$faker->seed($index);

return [
    'id' => $index + 1,
    'firstname' => $faker->firstName,
    'lastname' => $faker->lastName,
];