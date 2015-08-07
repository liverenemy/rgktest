<?php

namespace tests\unit\fixtures;

use yii\test\ActiveFixture;

/**
 * Author fixture
 */
class AuthorFixture extends ActiveFixture
{
    /**
     * @inheritdoc
     */
    public $modelClass = 'common\models\Author';

    /**
     * @inheritdoc
     */
    public $dataFile = '@tests/unit/fixtures/data/Author.php';
}