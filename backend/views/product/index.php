<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\helpers\Url;

/* @var $this yii\web\View */
/* @var $searchModel backend\models\ProductSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Products';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="product-index">

    <h1><?= Html::encode($this->title) ?> <i class="fa fa-info-circle" id="prodhelp" aria-hidden="true"></i></h1>
    <p>
        <?= Html::a('Create Product', ['create'], ['class' => 'btn btn-success','style'=>'background-color:#0033ff']) ?>
    </p>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
		    'id',
            'title',
            'description:ntext',
            [
                'attribute' => 'category_id',
                'value' => function ($model) {
                    return empty($model->category_id) ? '-' : $model->category->title;
                },
            ],
            'price',
            'instore',
			[
			  'class' => 'yii\grid\CheckboxColumn',
			  //'checkboxOptions' => function ($model, $key, $index, $column) {
              //return ['value' => $model->name];
			],
            [
                'class' => 'yii\grid\ActionColumn',
                'template' => '{view} {update} {images} {delete}',
                'buttons' => [
                    'images' => function ($url, $model, $key) {
                         return Html::a('<span class="glyphicon glyphicon glyphicon-picture" aria-label="Image"></span>', Url::to(['image/index', 'id' => $model->id]));
                    }
                ],
            ],
        ],
    ]); ?>

</div>

<div class="modal fade" id="prod_list">
   <div class="modal-dialog">
       <div class="modal-content">
	      <div class="modal-header" style="background-color:#0033ff;color:#ffffff">
		    Helpful Information
		  </div>
		  <div class="modal-body">
		    <p>
			   This is page for view list of product and
			   some details(name,price,quantity in store...).
			   You may create,update,view,delete information 
			   about products.
			</p>
			<br>
			  <h4>IMPORTANT NOTE!!!</h4>
			<p>
			   Image for product is load using SPECIAL ICON ON LIST,NOT IN CREATE PAGE
			</p>
		  </div>
		  <div class="modal-footer" style="background-color:#cccccc">
		     <button type="button" class="btn btn-danger" id="prodclose"><i class="fa fa-times" aria-hidden="true"></i></button>
		  </div>
       </div>
   </div>
</div>

<script>
  $(document).ready(function(){
	  $("#prodhelp").click(function(){
		  $("#prod_list").modal('show');
	  });
	  $("#prodclose").click(function(){
		  $("#prod_list").modal('hide');
	  });
  });
</script>