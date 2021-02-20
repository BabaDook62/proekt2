<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\Users */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="users-form">

    <?php $form = ActiveForm::begin([
  'action'=>'ogr?id='.$model->id]); ?>

    <?= $form->field($model, 'user_role')->dropDownList([
   'admin'=>'admin',
   'user'=>'user',
   'ban'=>'ban']); 
   ?>
   <?= $form->field($model, 'ogr')->dropDownList([
   'Yes'=>'Ограничить',
   'No'=>'Не ограничивать']); 
   ?>

    <?= $form->field($model, 'username')->textInput(['maxlength' => true]) ?>


    <div class="form-group">
        <?= Html::submitButton('Сохранить', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
