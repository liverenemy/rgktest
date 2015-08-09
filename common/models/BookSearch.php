<?php

namespace common\models;

use common\behaviors\DateCorrectBehavior;
use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use common\models\Book;
use yii\helpers\FormatConverter;

/**
 * BookSearch represents the model behind the search form about `common\models\Book`.
 */
class BookSearch extends Book
{
    /**
     * The latest publish date
     *
     * @var string
     */
    public $dateMax;

    /**
     * The earliest publish date
     *
     * @var string
     */
    public $dateMin;

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return array_merge(parent::attributeLabels(), [
            'dateMax' => Yii::t('app', 'Until'),
            'dateMin' => Yii::t('app', 'Book Publish Date'),
        ]);
    }

    /**
     * @inheritdoc
     */
    public function behaviors()
    {
        return [
            [
                'class' => DateCorrectBehavior::className(),
                DateCorrectBehavior::FIELDS => [
                    'date',
                    'dateMax',
                    'dateMin',
                ]
            ]
        ];
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'author_id'], 'integer'],
            [['name', 'date_create', 'date_update', 'preview', 'date', 'dateMin', 'dateMax',], 'string'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function scenarios()
    {
        // bypass scenarios() implementation in the parent class
        return Model::scenarios();
    }

    /**
     * Creates data provider instance with search query applied
     *
     * @param array $params
     *
     * @return ActiveDataProvider
     */
    public function search($params)
    {
        $query = Book::find()
            ->joinWith('author');

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
            'sort' => [
                'attributes' => [
                    'id',
                    'name',
                    'author_id' => [
                        'asc' => [
                            'authors.firstName' => SORT_ASC,
                            'authors.lastName' => SORT_ASC,
                        ],
                        'desc' => [
                            'authors.firstName' => SORT_DESC,
                            'authors.lastName' => SORT_ASC,
                        ],
                        'default' => SORT_ASC,
                    ],
                    'date',
                    'date_create',
                ],
            ],
        ]);

        $this->load($params);

        if (!$this->validate()) {
            // uncomment the following line if you do not want to return any records when validation fails
            // $query->where('0=1');
            return $dataProvider;
        }

        if (!empty($this->dateMax)) {
            $dt = new \DateTime($this->dateMax);
            $query->andWhere([
                '<=', 'date', $dt->format('Y-m-d'),
            ]);
        }

        if (!empty($this->dateMin)) {
            $dt = new \DateTime($this->dateMin);
            $query->andWhere([
                '>=', 'date', $dt->format('Y-m-d'),
            ]);
        }

        $query->andFilterWhere([
            'author_id' => $this->author_id,
        ]);

        $query->andFilterWhere(['ilike', 'name', $this->name]);

        return $dataProvider;
    }
}
