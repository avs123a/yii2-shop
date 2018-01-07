<?php

use yii\helpers\Html;
use yii\widgets\DetailView;
use yii\grid\GridView;
use yii\bootstrap\Modal;
use yii\widgets\Pjax;

/* @var $this yii\web\View */
/* @var $model common\models\Product */

$this->title = $model->title;
$this->params['breadcrumbs'][] = ['label' => 'Products', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="product-view">

    <h1><?= Html::encode($this->title) ?> <i class="fa fa-info-circle" id="prodinfohelp" aria-hidden="true"></i></h1>

    <p>
        <?= Html::a('Update', ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Delete', ['delete', 'id' => $model->id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => 'Are you sure you want to delete this item?',
                'method' => 'post',
            ],
        ]) ?>
    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'id',
            'title',
            'description:ntext',
            'category_id',
            'price',
			'instore',
        ],
    ]) ?>

</div>
<hr>
<div>
	  <!-- <p>
        <h3>Attributes for this product</h3><?//= Html::a('Create Product Attributes', ['//product-attributes/create','product_id'=>$model->id], ['class' => 'btn btn-success','style' => 'background-color:#0033ff']) ?>
      </p> -->
	  <h3>Attributes for this product</h3>
	<?php
      Modal::begin(['header' => 'Add new attribute for this product',
	  'toggleButton' => ['label' => 'Add attribute','tag' =>'button','class' => 'btn btn-success','style' => 'background-color:#0033ff'],'footer' => '', ]);
    ?>
  
    <?=$this->render('//product-attributes/_form',['model' => new \common\models\ProductAttributes(['product_id' => $model->id]) ]); ?>
  
  <?php Modal::end(); ?>
	  
	  <?= GridView::widget([
        'dataProvider' => $dataProviderAttr,
        'filterModel' => $searchModelAttr,
        'columns' => [
            'id',
            'attr_title',

            [
			  'class' => 'yii\grid\ActionColumn',
			  'controller' => 'product-attributes',
			],
        ],
    ]); ?>
</div>
<hr>
<h3>Feedback</h3>
<button type="button" id="fdbshow1">show <i class="fa fa-level-down" aria-hidden="true"></i></button>
<button type="button" id="fdbhide1" hidden="hidden">hide <i class="fa fa-level-up" aria-hidden="true"></i></button>
<div id="feedbacks1" hidden="hidden">
<?php Pjax::begin() ?> 
<?= GridView::widget([
        'dataProvider' => $dataProviderFeedBack,
        'filterModel' => $searchModelFeedBack,
        'columns' => [

            'id',
            'id_user',
            'comment',

            [
			  'class' => 'yii\grid\ActionColumn',
			  'controller' => 'product-feedback',
			],
        ],
    ]); ?>
<?php Pjax::end() ?> 
</div>

<div class="modal fade" id="prod_info">
   <div class="modal-dialog">
       <div class="modal-content">
	      <div class="modal-header" style="background-color:#0033ff;color:#ffffff">
		    Helpful Information
		  </div>
		  <div class="modal-body">
		    <p>
			   This is page for view product details.
			   You may view product details , attributes and comments(reviews/feedback).
			   Also you may update product, create attributes , control feedback ...
			</p>
		  </div>
		  <div class="modal-footer" style="background-color:#cccccc">
		     <button type="button" class="btn btn-danger" id="prodhelpclose"><i class="fa fa-times" aria-hidden="true"></i></button>
		  </div>
       </div>
   </div>
</div>

<script>
  $(document).ready(function(){
	  $("#prodinfohelp").click(function(){
		  $("#prod_info").modal('show');
	  });
	  $("#prodhelpclose").click(function(){
		  $("#prod_info").modal('hide');
	  });
	  $("#fdbshow1").click(function(){
		  $("#feedbacks1").show();
		  $("#fdbhide1").show();
		  $("#fdbshow1").hide();
	  });
	  $("#fdbhide1").click(function(){
		  $("#feedbacks1").hide();
		  $("#fdbshow1").show();
		  $("#fdbhide1").hide();
	  });
	  
  });
</script>