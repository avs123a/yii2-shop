<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel backend\models\CategorySearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Categories';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="category-index">

    <h1><?= Html::encode($this->title) ?> <i class="fa fa-info-circle" id="categoryhelp" aria-hidden="true"></i></h1>
    <p>
        <?= Html::a('Create Category', ['create'], ['class' => 'btn btn-success','style'=>'background-color:#0033ff']) ?>
    </p>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            'id',
            [
                'attribute' => 'parent_id',
                'value' => function ($model) {
                    return empty($model->parent_id) ? '-' : $model->parent->title;
                },
            ],

            'title',

            [
                'class' => 'yii\grid\ActionColumn',
                'template' => '{create} {view} {update} {delete}',
                'buttons' => [
                    'create' => function ($url, $model, $key) {
                         return Html::a('<span class="glyphicon glyphicon-plus" aria-hidden="true"></span>', $url);
                    }
                ],
            ],
        ],
    ]); ?>

</div>

<div class="modal fade" id="categories1">
   <div class="modal-dialog">
       <div class="modal-content">
	      <div class="modal-header" style="background-color:#0033ff;color:#ffffff">
		    Helpful Information
		  </div>
		  <div class="modal-body">
		    <p>
			   This is page for view list of product categories.
			   You may create,view,update and delete categories.
			   BE ACCURACY WITH PARENT CATEGORIES!!!
			</p>
		  </div>
		  <div class="modal-footer" style="background-color:#cccccc">
		     <button type="button" class="btn btn-danger" id="categotyclose"><i class="fa fa-times" aria-hidden="true"></i></button>
		  </div>
       </div>
   </div>
</div>

<script>
  $(document).ready(function(){
	  $("#categoryhelp").click(function(){
		  $("#categories1").modal('show');
	  });
	  $("#categotyclose").click(function(){
		  $("#categories1").modal('hide');
	  });
  });
</script>