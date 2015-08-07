<?php
/**
 * @var $faker \Faker\Generator
 * @var $index integer
 */
$faker->seed($index);
$row = $index + 1;
return [
    'id' => $index + 1,
    'username' => 'user' . $row,
    'auth_key' => Yii::$app->getSecurity()->generateRandomString(),
    'password_hash' => Yii::$app->getSecurity()->generatePasswordHash('123123'),
    'password_reset_token' =>Yii::$app->getSecurity()->generateRandomString() . '_' . time(),
    'email' => "user{$row}@gmail.com",
    'created_at' => time(),
    'updated_at' => time(),
];
