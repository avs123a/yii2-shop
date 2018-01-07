<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel backend\models\MethodSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Methods';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="method-index">

    <h1><?= Html::encode($this->title) ?> <i class="fa fa-info-circle" id="methodhelp" aria-hidden="true"></i></h1>

    <p>
        <?//= Html::a('Create Method', ['create'], ['class' => 'btn btn-success','style'=>'background-color:#0033ff']) ?>
    </p>
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            'id',
            'title',
            'wmid_or_merchant',
            'wallet',

            [
			'class' => 'yii\grid\ActionColumn',
			'template'=>'{view},{update}',
			],
        ],
    ]); ?>
</div>

<div class="modal fade" id="method1">
   <div class="modal-dialog">
       <div class="modal-content">
	      <div class="modal-header" style="background-color:#0033ff;color:#ffffff">
		    Helpful Information
		  </div>
		  <div class="modal-body">
		    <p>
			   This is page for view payment methods.
			   You may ONLY VIEW OR UPDATE METHODS(NOT CREATE OR DELETE IN THIS SITE)
			</p>
		  </div>
		  <div class="modal-footer" style="background-color:#cccccc">
		     <button type="button" class="btn btn-danger" id="methodclose"><i class="fa fa-times" aria-hidden="true"></i></button>
		  </div>
       </div>
   </div>
</div>

<script>
  $(document).ready(function(){
	  $("#methodhelp").click(function(){
		  $("#method1").modal('show');
	  });
	  $("#methodclose").click(function(){
		  $("#method1").modal('hide');
	  });
  });
</script>