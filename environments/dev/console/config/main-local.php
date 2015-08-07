<?php
return [
    'bootstrap' => ['gii'],
    'controllerMap' => [
        'fixture' => [
            'class' => 'yii\faker\FixtureController',
        ],
    ],
    'modules' => [
        'gii' => 'yii\gii\Module',
    ],
];
