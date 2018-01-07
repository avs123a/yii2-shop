<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model common\models\ProductAttributeValue */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="product-attribute-value-form">
    <?php
	  if($model->isNewRecord)
	  {
		 $action = \yii\helpers\Url::to(['//product-attribute-value/create','attr_id' => $model->attr_id]);
	  }
	  else
	  {
		 $action = \yii\helpers\Url::to(['//product-attribute-value/update','id' => $model->id]);
	  }
	?>
    <?php $form = ActiveForm::begin([
	    'action' => $action,
	]); ?>

    <?= $form->field($model, 'value')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'price_coef')->textInput() ?>

    <?= $form->field($model, 'quantity_percent')->textInput() ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['style' => 'background-color:#0033ff','class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
