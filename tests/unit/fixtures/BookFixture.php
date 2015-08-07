<?php

namespace tests\unit\fixtures;

use yii\test\ActiveFixture;

/**
 * Book fixture
 */
class BookFixture extends ActiveFixture
{
    /**
     * @inheritdoc
     */
    public $modelClass = 'common\models\Book';

    /**
     * @inheritdoc
     */
    public $dataFile = '@tests/unit/fixtures/data/Book.php';
}