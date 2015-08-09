<?php

use common\models\Book;
use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model Book */

$this->title = $model->name;
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Books'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="book-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <? if (empty($noButtons)): ?>
    <p>
        <?= Html::a(Yii::t('app', 'Update'), ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a(Yii::t('app', 'Delete'), ['delete', 'id' => $model->id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => Yii::t('app', 'Are you sure you want to delete this item?'),
                'method' => 'post',
            ],
        ]) ?>
    </p>
    <? endif ?>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'id',
            'name',
            'date_create:dateTime',
            'date_update:dateTime',
            'preview:image',
            'date:date',
            [
                'label' => $model->getAttributeLabel('author_id'),
                'value' => $model->author,
            ],
        ],
    ]) ?>

</div>
