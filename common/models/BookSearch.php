<?php

namespace common\models;

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
    public function load($data, $formName = null)
    {
        $result = parent::load($data, $formName);
        $this->dateMax = $this->_normalizeDate($this->dateMax);
        $this->dateMin = $this->_normalizeDate($this->dateMin);
        return $result;
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'author_id'], 'integer'],
            [['name', 'date_create', 'date_update', 'preview', 'date', 'dateMin', 'dateMax',], 'safe'],
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
            ->with('author');

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
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
            'id' => $this->id,
            'date_create' => $this->date_create,
            'date_update' => $this->date_update,
            'date' => $this->date,
            'author_id' => $this->author_id,
        ]);

        $query->andFilterWhere(['like', 'name', $this->name])
            ->andFilterWhere(['like', 'preview', $this->preview]);

        return $dataProvider;
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
        if (empty($parts) || !is_array($parts) || 3 != count($parts)) {
            return $date;
        }
        return $parts[2] . '-' . $parts[1] . '-' . $parts[0];
    }
}