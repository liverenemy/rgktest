<?php
/**
 * @var $faker \Faker\Generator
 * @var $index integer
 */
$dir = '/upload/images/';
$faker->seed($index);
$row = $index + 1;
$name = $faker->sentence(3);
$created = $faker->dateTimeBetween('-5 years', 'now');
$updated = $faker->dateTimeBetween($created->format('Y-m-d H:i:s'), 'now');
$authorCount = \common\models\Author::find()->count();
return [
    'id' => $index + 1,
    'name' => mb_substr($name, 0, mb_strlen($name) - 1),
    'date_create' => $created->getTimestamp(),
    'date_update' => $updated->getTimestamp(),
    'preview' => $dir . $faker->image(\Yii::$app->basePath . '/../frontend/web/upload/images', 640, 480, null, false),
    'date' => $faker->date('Y-m-d', $created->format('Y-m-d')),
    'author_id' => $faker->numberBetween(1, $authorCount),
];
