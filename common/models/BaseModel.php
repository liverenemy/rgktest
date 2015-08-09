<?php

namespace common\models;
use yii\db\ActiveQueryInterface;
use yii\db\ActiveRecord;
use yii\helpers\ArrayHelper;

/**
 * Base model
 *
 * @author Sergey Cherdantsev <cherdancev@yandex.ru>
 */

class BaseModel extends ActiveRecord
{
    /**
     * Builds a map (key-value pairs) for DropDownList
     * @param ActiveQueryInterface $query
     * @param string $stringField
     * @param boolean $needTranslate
     * @return array
     */
    static public function getArrayMap(ActiveQueryInterface $query = null, $stringField = null, $needTranslate = false)
    {
        static $cache = NULL;

        $key = md5(serialize($query).serialize($stringField).get_called_class());

        if(isset($cache[$key])) {
            return $cache[$key];
        }

        if (is_null($query)) {
            $query = self::find();
        }

        return $cache[$key] = ArrayHelper::map(
            $query->all(),
            function (BaseModel $item) {
                return $item->getPrimaryKey();
            },
            function (BaseModel $item) use ($stringField, $needTranslate) {
                if (!empty($stringField) && isset($item->$stringField)) {
                    $string = $item->$stringField;
                } else {
                    $string = (string)$item;
                }

                if ($needTranslate) {
                    return \Yii::t('app', $string);
                } else {
                    return $string;
                }
            }
        );
    }

    /**
     * Magic method for string representation of the models
     *
     * @return mixed|string
     */
    public function __toString()
    {
        $attrs = [
            'name',
            'title',
        ];

        foreach ($attrs as $attr) {
            if ($this->__isset($attr)) {
                return $this->__get($attr);
            }
        }

        return $this->getPrimaryKey() . ' ' . get_called_class();
    }
}