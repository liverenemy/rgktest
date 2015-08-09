<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\jui\DatePicker;
use common\models\Author;
use frontend\assets\BookAsset;

/* @var $this yii\web\View */
/* @var $model common\models\BookSearch */
/* @var $form yii\widgets\ActiveForm */
/* @var $pjax boolean */

BookAsset::register($this);
?>

<div class="book-search">
    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
        'options' => [
            'class' => 'form-inline',
            'data-pjax' => !empty($pjax),
        ],
    ]); ?>
    <div class="row">
        <div class="col-xs-3 form-group">
            <?= Html::activeDropDownList(
                $model,
                'author_id',
                Author::getArrayMap(
                    Author::find()->orderBy('firstName, lastName')
                ),
                [
                    'class' => 'form-control',
                    'prompt' => $model->getAttributeLabel('author_id'),
                ]
            ) ?>
        </div>
        <div class="col-xs-3 form-group">
            <?= Html::activeInput('text', $model, 'name', [
                'class' => 'form-control',
                'placeholder' => $model->getAttributeLabel('name'),
            ]) ?>
        </div>
    </div>
    <div class="row">
        <div class="col-xs-4 form-group">
            <?= Html::activeLabel($model, 'dateMin') ?>:
            <?= DatePicker::widget([
                'clientOptions' => [
                    'changeMonth' => true,
                    'changeYear' => true,
                ],
                'dateFormat' => 'dd/MM/yyyy',
                'model' => $model,
                'attribute' => 'dateMin',
                'options' => [
                    'class' => 'form-control',
                ],
            ]) ?>
        </div>
        <div class="col-xs-6 form-group">
            <?= Html::activeLabel($model, 'dateMax') ?>:
            <?= DatePicker::widget([
                'clientOptions' => [
                    'changeMonth' => true,
                    'changeYear' => true,
                ],
                'dateFormat' => 'dd/MM/yyyy',
                'model' => $model,
                'attribute' => 'dateMax',
                'options' => [
                    'class' => 'form-control',
                ],
            ]) ?>
        </div>
        <div class="col-xs-2 form-group">
            <?= Html::submitButton(Yii::t('app', 'Search'), ['class' => 'btn btn-primary pull-right']) ?>
        </div>
    </div>

    <?php ActiveForm::end(); ?>

</div>
