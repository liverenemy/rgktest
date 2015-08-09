<?php
/**
 * Date correct behavior
 *
 * @author Sergey Cherdantsev <cherdancev@yandex.ru>
 */

namespace common\behaviors;


use yii\base\Behavior;
use yii\base\Model;
use yii\db\ActiveRecord;

class DateCorrectBehavior extends Behavior
{
    const FIELDS = 'fields';

    /**
     * @inheritdoc
     */
    public function events()
    {
        return [
            Model::EVENT_BEFORE_VALIDATE => 'correctFields',
        ];
    }

    /**
     * Names of the fields to correct
     *
     * @var array|string[]
     */
    public $fields = [];

    /**
     * Process field correction
     */
    public function correctFields()
    {
        /** @var ActiveRecord $owner */
        $owner = $this->owner;
        foreach ($this->fields as $field) {
            $old = $owner->$field;
            $new = $this->_normalizeDate($old);
            $this->owner->$field = $new;
        }
    }

    /**
     * Transform a date from 'd/m/Y' to 'Y-m-d' format
     *
     * @param string $date Date in 'd/m/Y' format
     * @return string
     */
    protected function _normalizeDate($date)
    {
        $parts = explode('/', $date);
        if (\Yii::$app->language != 'ru' || empty($parts) || !is_array($parts) || 3 != count($parts)) {
            return $date;
        }
        return $parts[2] . '-' . $parts[1] . '-' . $parts[0];
    }
}