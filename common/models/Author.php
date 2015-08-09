<?php

namespace common\models;

use Yii;
use common\models\query\AuthorQuery;

/**
 * This is the model class for table "authors".
 *
 * @property integer $id
 * @property string $firstname
 * @property string $lastname
 *
 * @property string $name
 * @property Book[] $books
 */
class Author extends BaseModel
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'authors';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['firstname', 'lastname'], 'string', 'max' => 255]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'firstname' => Yii::t('app', 'First name'),
            'lastname' => Yii::t('app', 'Last name'),
        ];
    }

    /**
     * @inheritdoc
     * @return \common\models\query\AuthorQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new AuthorQuery(get_called_class());
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getBooks()
    {
        return $this->hasMany(Book::className(), ['author_id' => 'id']);
    }

    /**
     * Get author's full name
     *
     * @return string
     */
    public function getName()
    {
        return $this->firstname . ' ' . $this->lastname;
    }
}
