<?php

namespace common\models\query;

/**
 * This is the ActiveQuery class for [[\common\models\Author]].
 *
 * @see \common\models\Author
 */
class AuthorQuery extends \common\models\query\BaseQuery
{
    /*public function active()
    {
        $this->andWhere('[[status]]=1');
        return $this;
    }*/

    /**
     * @inheritdoc
     * @return \common\models\Author[]|array
     */
    public function all($db = null)
    {
        return parent::all($db);
    }

    /**
     * @inheritdoc
     * @return \common\models\Author|array|null
     */
    public function one($db = null)
    {
        return parent::one($db);
    }
}