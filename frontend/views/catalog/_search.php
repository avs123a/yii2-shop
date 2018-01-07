<?php
use yii\helpers\Html;
use yii\helpers\Url;
use yii\widgets\ActiveForm;
?>

<?php $form2=ActiveForm::begin([
  'id' => 'globsearch',
  'action' => Url::to(['catalog/list',]),
]) ?>
   <?=$form2->field($model,'globalSearch'); ?>
   <?= Html::submitButton('Search', ['name' => 'gsearch','class' => 'btn btn-success','style'=>'background-color:#0033ff']) ?>
<?php ActiveForm::end() ?>