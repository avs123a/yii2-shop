<?php
use yii\helpers\Html;
use yii\widgets\ActiveForm;
//$this->title = 'Update Profile';
?>
<?php $form = ActiveForm::begin(); ?>
<h2>Update your profile</h2>
<hr>
<div class="row">
   <h3>&nbsp;&nbsp;Personal information</h3>
  <div class="col-xs-6">
     <?= $form->field($model,'surname') ?>
  </div>
  <div class="col-xs-6">
     <?= $form->field($model,'name') ?>
  </div>
</div>
<hr>
<div class="row">
  <h3>&nbsp;&nbsp;Your address</h3>
  <div class="col-xs-6">
     <?= $form->field($model,'country') ?>
     <?= $form->field($model,'region') ?>
	 <?= $form->field($model,'city') ?>
  </div>
  <div class="col-xs-6">
     <?= $form->field($model,'address') ?>
	 <?= $form->field($model,'zip_code') ?>
  </div>
</div>
<hr>
 <h3>Contact information</h3>
  <?= $form->field($model,'phone') ?>
  <div class="form-group">
     <?= Html::SubmitButton('Save Profile',['style'=>'background-color:#0033ff','class' =>'btn btn-success']) ?>
  </div>
<?php ActiveForm::end(); ?>
