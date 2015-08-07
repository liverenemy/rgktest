<?php

namespace tests\unit\fixtures;

use yii\test\ActiveFixture;

/**
 * User fixture
 */
class UserFixture extends ActiveFixture
{
    /**
     * @inheritdoc
     */
    public $modelClass = 'common\models\User';

    /**
     * @inheritdoc
     */
    public $dataFile = '@tests/unit/fixtures/data/User.php';
}