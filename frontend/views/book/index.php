<?php

use yii\helpers\Html;
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

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a(Yii::t('app', 'Create Book'), ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
//            ['class' => 'yii\grid\SerialColumn'],

            'id',
            'name',
            [
                'class' => DataColumn::className(),
                'attribute' => 'date_create',
                'content' => function(Book $model) {
                    $dt = new \DateTime();
                    $dt->setTimestamp($model->date_create);
                    return Html::tag(
                        'span',
                        \Yii::$app->formatter->asRelativeTime($model->date_create),
                        [
                            'class' => 'dotted',
                            'title' => \Yii::$app->formatter->asDatetime($dt),
                        ]
                    );
                }
            ],
            [
                'class' => DataColumn::className(),
                'attribute' => 'date_update',
                'content' => function(Book $model) {
                    $dt = new \DateTime();
                    $dt->setTimestamp($model->date_update);
                    return Html::tag(
                        'span',
                        \Yii::$app->formatter->asRelativeTime($model->date_update),
                        [
                            'class' => 'dotted',
                            'title' => \Yii::$app->formatter->asDatetime($dt),
                        ]
                    );
                }
            ],
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
                'content' => function(Book $model) {
                    return Html::a(
                        Yii::t('app', '[view]'),
                        [
                            'view',
                            'id' => $model->id,
                        ],
                        [
                            'class' => 'ajax-view',
                            'data' => [
                                'key' => $model->id,
                            ],
                            'title' => $model->name,
                        ]
                    );
                },
                'label' => Yii::t('app', 'Action Buttons'),
            ],
//            'preview',
            // 'date',
            // 'author_id',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>

</div>
<?
$this->registerJs(new \yii\web\JsExpression(<<<JS
jQuery('a.preview').colorbox({
    rel: 'previewGallery'
});
jQuery('a.ajax-view').each(function(){
    var id = jQuery(this).data('key');
    jQuery(this).colorbox({

    });
});
JS
));