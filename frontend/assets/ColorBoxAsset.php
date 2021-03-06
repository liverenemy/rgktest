<?php

namespace frontend\assets;
use yii\web\AssetBundle;

/**
 * Book asset
 *
 * @author Sergey Cherdantsev <cherdancev@yandex.ru>
 */

class ColorBoxAsset extends AssetBundle
{
    /**
     * @inheritdoc
     */
    public $css = [
        'example1/colorbox.css',
    ];

    /**
     * @inheritdoc
     */
    public $js = [
        'jquery.colorbox-min.js',
    ];

    /**
     * @inheritdoc
     */
    public $depends = [
        'yii\bootstrap\BootstrapAsset',
        'yii\web\JqueryAsset',
    ];

    /**
     * @inheritdoc
     */
    public $sourcePath = '@frontend/resources/js/colorbox-master';

    /**
     * Check for the application language and append language files if they exist for the current application language
     *
     * Why not dedicated Language model with methods for file asset appending?
     * @link https://github.com/yiisoft/yii2/issues/728#issuecomment-30958621
     * For this single case that's enough.
     */
    protected function appendLanguageFiles()
    {
        $language = \Yii::$app->language;
        $sourceLanguage = \Yii::$app->sourceLanguage;

        if ($language != $sourceLanguage) {
            $this->js[] = "i18n/jquery.colorbox-$language.js";
        }
    }

    /**
     * @inheritdoc
     */
    public function init()
    {
        parent::init();
        static::appendLanguageFiles();
    }
}