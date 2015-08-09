<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\jui\DatePicker;
use kartik\widgets\FileInput;
use common\models\Author;

/* @var $this yii\web\View */
/* @var $model common\models\Book */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="book-form">

    <?php $form = ActiveForm::begin([
        'options' => ['enctype'=>'multipart/form-data'],
    ]); ?>

    <?= $form->field($model, 'name')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'previewFile')->fileInput() ?>

    <?= $form->field($model, 'date')->widget(DatePicker::className(), [
        'clientOptions' => [
            'changeMonth' => true,
            'changeYear' => true,
        ],
        'dateFormat' => 'dd/MM/yyyy',
        'options' => [
            'class' => 'form-control',
        ]
    ]) ?>

    <?= $form->field($model, 'author_id')->dropDownList(
        Author::getArrayMap(),
        [
            'prompt' => $model->getAttributeLabel('author_id'),
        ]
    ) ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? Yii::t('app', 'Create') : Yii::t('app', 'Update'), [
            'class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary'
        ]) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
