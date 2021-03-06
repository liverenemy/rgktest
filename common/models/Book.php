<?php

namespace common\models;

use common\behaviors\DateCorrectBehavior;
use Yii;
use common\models\query\BookQuery;
use yii\behaviors\TimestampBehavior;
use yii\db\ActiveRecord;
use common\web\UploadedFile;

/**
 * This is the model class for table "books".
 *
 * @property integer $id
 * @property string $name
 * @property string $date_create
 * @property string $date_update
 * @property string $preview
 * @property string $date
 * @property integer $author_id
 *
 * @property Author $author
 */
class Book extends BaseModel
{
    /**
     * New preview file
     *
     * @var UploadedFile
     */
    public $previewFile;

    /**
     * @inheritdoc
     */
    public function behaviors()
    {
        return array_merge(parent::behaviors(), [
            [
                'class' => TimestampBehavior::className(),
                'attributes' => [
                    ActiveRecord::EVENT_BEFORE_INSERT => ['date_create', 'date_update'],
                    ActiveRecord::EVENT_BEFORE_UPDATE => ['date_update'],
                ],
            ],
            [
                'class' => DateCorrectBehavior::className(),
                DateCorrectBehavior::FIELDS => ['date'],
            ]
        ]);
    }

    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'books';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['name', 'date'], 'required'],
            [['date_create', 'date_update', 'date'], 'safe'],
            [['author_id'], 'integer'],
            [['name', 'preview'], 'string', 'max' => 255],
            [
                [
                    'previewFile',
                ],
                'image',
                'extensions' => [
                    'jpg',
                    'jpeg',
                    'png',
                ],
                'maxHeight' => 1000,
                'maxWidth' => 1000,
                'minHeight' => 100,
                'minWidth' => 100,
            ],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'name' => Yii::t('app', 'Name'),
            'date_create' => Yii::t('app', 'Created at'),
            'date_update' => Yii::t('app', 'Updated at'),
            'preview' => Yii::t('app', 'Preview'),
            'previewFile' => Yii::t('app', 'Preview'),
            'date' => Yii::t('app', 'Book Publish Date'),
            'author_id' => Yii::t('app', 'Author'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getAuthor()
    {
        return $this->hasOne(Author::className(), ['id' => 'author_id']);
    }

    /**
     * @inheritdoc
     * @return \common\models\query\BookQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new BookQuery(get_called_class());
    }

    /**
     * @inheritdoc
     */
    public function load($data, $formName = null)
    {
        $result = parent::load($data, $formName);
        $this->previewFile = UploadedFile::getInstance($this, 'previewFile');
        return $result;
    }

    /**
     * @inheritdoc
     */
    public function save($runValidation = true, $attributeNames = null)
    {
        if (!empty($this->previewFile)) {
            $url = $this->previewFile->saveAsImage(false);
            if (!empty($url)) {
                $this->preview = $url;
            }
        }
        return parent::save($runValidation, $attributeNames);
    }
}
