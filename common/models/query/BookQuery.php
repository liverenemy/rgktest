<?php

namespace common\models\query;

/**
 * This is the ActiveQuery class for [[\common\models\Book]].
 *
 * @see \common\models\Book
 */
class BookQuery extends \common\models\query\BaseQuery
{
    /*public function active()
    {
        $this->andWhere('[[status]]=1');
        return $this;
    }*/

    /**
     * @inheritdoc
     * @return \common\models\Book[]|array
     */
    public function all($db = null)
    {
        return parent::all($db);
    }

    /**
     * @inheritdoc
     * @return \common\models\Book|array|null
     */
    public function one($db = null)
    {
        return parent::one($db);
    }
}