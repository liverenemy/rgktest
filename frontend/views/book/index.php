<?php

use yii\helpers\Html;
use common\grid\ActionColumn;
use yii\grid\DataColumn;
use yii\grid\GridView;
use common\models\Book;
use frontend\assets\BookAsset;
use frontend\assets\ColorBoxAsset;

/* @var $this yii\web\View */
/* @var $searchModel common\models\BookSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

BookAsset::register($this);
ColorBoxAsset::register($this);
$this->title = Yii::t('app', 'Books');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="book-index">
    <p class="pull-right">
        <?= Html::a(Yii::t('app', 'Create Book'), ['create'], ['class' => 'btn btn-success']) ?>
    </p>
    <h1><?= Html::encode($this->title) ?></h1>
    <?= $this->render('_search', ['model' => $searchModel]); ?>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
//        'filterModel' => $searchModel,
        'columns' => [
            'id',
            'name',
            [
                'class' => DataColumn::className(),
                'attribute' => 'preview',
                'content' => function(Book $model) {
                    return Html::a(
                        Html::img($model->preview, [
                            'class' => 'table-img',
                        ]),
                        [
                            $model->preview
                        ],
                        [
                            'class' => 'preview',
                            'title' => $model->name,
                        ]
                    );
                },
            ],
            [
                'class' => DataColumn::className(),
                'attribute' => 'author_id',
                'label' => Yii::t('app', 'Author'),
                'content' => function(Book $model) {
                    $author = $model->author;
                    if (empty($author)) {
                        return '';
                    }
                    return $author->name;
                },
            ],
            [
                'class' => DataColumn::className(),
                'attribute' => 'date',
                'content' => function(Book $model) {
                    if (empty($model->date)) {
                        return '';
                    }
                    return \Yii::$app->formatter->asDate($model->date);
                }
            ],
            [
                'class' => DataColumn::className(),
                'attribute' => 'date_create',
                'content' => function(Book $model) {
                    return $this->render('blocks/relativeTime', [
                        'timestamp' => $model->date_create,
                    ]);
                }
            ],

            [
                'class' => ActionColumn::className(),
                'buttons' => [
                    'update' => function($url, Book $model, $key) {
                        return Html::a(
                            Yii::t('app', '[update]'),
                            $url
                        );
                    },
                ],
                'header' => Yii::t('app', 'Action Buttons'),
                'headerOptions' => [
                    'colspan' => 3,
                ],
                'template' => '{update}',
            ],

            [
                'class' => ActionColumn::className(),
                'buttons' => [
                    'view' => function($url, Book $model, $key) {
                        return Html::a(
                            Yii::t('app', '[view]'),
                            $url,
                            [
                                'class' => 'ajax-view',
                                'data' => [
                                    'key' => $model->id,
                                ],
                                'title' => $model->name,
                            ]
                        );
                    },
                ],
                'showHeader' => false,
                'template' => '{view}',
            ],

            [
                'class' => ActionColumn::className(),
                'buttons' => [
                    'delete' => function($url, Book $model, $key) {
                        return Html::a(
                            Yii::t('app', '[delete]'),
                            $url,
                            [
                                'data-confirm' => Yii::t('yii', 'Are you sure you want to delete this item?'),
                                'data-method' => 'post',
                                'data-pjax' => '0',
                            ]
                        );
                    },
                ],
                'showHeader' => false,
                'template' => '{delete}',
            ],
        ],
    ]); ?>

</div>
<?
$this->registerJs(new \yii\web\JsExpression(<<<JS
jQuery('a.preview').colorbox({
    rel: 'previewGallery'
});
jQuery('a.ajax-view').each(function(){
    jQuery(this).colorbox({});
});
JS
));