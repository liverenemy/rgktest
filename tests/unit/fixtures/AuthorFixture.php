<?php

namespace common\fixtures;

use yii\test\BaseActiveFixture;

/**
 * Author fixture
 */
class AuthorFixture extends BaseActiveFixture
{
    /**
     * @inheritdoc
     */
    public $modelClass = 'common\models\Author';

    /**
     * @inheritdoc
     */
    public $dataFile = '@common/fixtures/data/Author.php';
}