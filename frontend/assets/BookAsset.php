<?php

namespace frontend\assets;
use yii\web\AssetBundle;

/**
 * Book asset
 *
 * @author Sergey Cherdantsev <cherdancev@yandex.ru>
 */

class BookAsset extends AssetBundle
{
    /**
     * @inheritdoc
     */
    public $css = [
        'css/books.css',
    ];

    /**
     * @inheritdoc
     */
    public $js = [
    ];

    /**
     * @inheritdoc
     */
    public $depends = [
    ];

    /**
     * @inheritdoc
     */
    public $sourcePath = '@frontend/resources';
}