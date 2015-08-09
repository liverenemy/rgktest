<?php

namespace common\web;

use Yii;
use yii\base\InvalidConfigException;

/**
 * Uploaded file that can save itself to the correct folder
 *
 * @author Sergey Cherdantsev <cherdancev@yandex.ru>
 */

class UploadedFile extends \yii\web\UploadedFile
{
    /**
     * Path where to save the content
     *
     * @var string
     */
    protected $_basePath = '@frontend/web/uploads';

    /**
     * Base URL of the publishing content
     *
     * @var string
     */
    protected $_baseUrl = '/uploads';

    /**
     * Path where to save images
     *
     * @var string
     */
    protected $_imagePath = '@frontend/web/uploads/images';

    /**
     * Base URL of publishing images
     *
     * @var string
     */
    protected $_imageUrl = '/uploads/images';

    /**
     * @inheritdoc
     */
    public function init()
    {
        parent::init();
        foreach (['basePath', 'baseUrl', 'imagePath', 'imageUrl'] as $name) {
            $this->initParam($name);
        }
    }

    /**
     * Initialize the specified parameter with the application config value
     *
     * @param string $name Param name
     * @return bool Whether the param was correctly initialized
     */
    public function initParam($name)
    {
        $var = '_' . $name;
        if (!property_exists($this, $var)) {
            return false;
        }
        $app = Yii::$app;
        if (!empty($app->params['upload']) && !empty($app->params['upload'][$name])) {
            $this->$var = rtrim($app->params['upload'][$name], DIRECTORY_SEPARATOR);
            return true;
        }
        return false;
    }

    public function save($deleteTempFile = true)
    {
        $fileName = $this->_createFileName($this->_basePath);
        $fullName = $this->_basePath . DIRECTORY_SEPARATOR . $fileName;
        if ($this->saveAs($fullName, $deleteTempFile)) {
            return $this->_baseUrl . DIRECTORY_SEPARATOR . $fileName;
        }
        return null;
    }

    public function saveAsImage($deleteTempFile = true)
    {
        $fileName = $this->_createFileName($this->_imagePath);
        $fullName = Yii::getAlias($this->_imagePath) . DIRECTORY_SEPARATOR . $fileName;
        if ($this->saveAs($fullName, $deleteTempFile)) {
            return $this->_imageUrl . DIRECTORY_SEPARATOR . $fileName;
        }
        return null;
    }

    protected function _createFileName($folder, $prefix = '')
    {
        $dir = rtrim(Yii::getAlias($folder), DIRECTORY_SEPARATOR);
        $basePath = Yii::$app->basePath;
        if (mb_strpos($dir, $basePath) === false)
        {
            throw new InvalidConfigException('The upload file path is not configured for ' . __CLASS__);
        }
        if (!is_writable($dir)) {
            throw new InvalidConfigException('The specified directory is not writable: ' . $folder);
        }
        while (true) {
            $fileName = uniqid($prefix, true) . '.' . $this->extension;
            $fullName =  $dir . DIRECTORY_SEPARATOR . $fileName;
            if (!file_exists($fullName)) return $fileName;
        }
        return null;
    }
}