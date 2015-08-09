<?php

namespace common\grid;

/**
 * Extended ActionColumn
 *
 * @author Sergey Cherdantsev <cherdancev@yandex.ru>
 */

class ActionColumn extends \yii\grid\ActionColumn
{
    /**
     * Whether to show the header cell
     *
     * @var boolean
     */
    public $showHeader;

    /**
     * @inheritdoc
     */
    public function renderHeaderCell()
    {
        if ($this->showHeader === false) {
            return '';
        }
        return parent::renderHeaderCell();
    }
}