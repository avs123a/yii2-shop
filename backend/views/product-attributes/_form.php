<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model common\models\ProductAttributes */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="product-attributes-form">
    <?php
	if($model->isNewRecord)
	  {
		 $action = \yii\helpers\Url::to(['//product-attributes/create','product_id' =>$model->product_id]);
	  }
	  else
	  {
		 $action = \yii\helpers\Url::to(['//product-attributes/update','id' =>$model->id]);
	  }
    ?>
    <?php $form = ActiveForm::begin([
	  'action' => $action,
	]); ?>

    

    <?= $form->field($model, 'attr_title')->textInput(['maxlength' => true]) ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['style' => 'background-color:#0033ff','class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
