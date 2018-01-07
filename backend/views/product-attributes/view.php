<?php

use yii\helpers\Html;
use yii\widgets\DetailView;
use yii\grid\GridView;
use yii\bootstrap\Modal;

/* @var $this yii\web\View */
/* @var $model common\models\ProductAttributes */

$this->title = $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Product Details', 'url' => ['//product/view','id' => $model->product_id]];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="product-attributes-view">

    <h1><?= Html::encode($this->title) ?>  <i class="fa fa-info-circle" id="atribhelp" aria-hidden="true"></i></h1>

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
            'product_id',
            'attr_title',
        ],
    ]) ?>

</div>
<hr>
<div>
  <!-- <p>
      <h3>Values of this attribute</h3>  <?//= Html::a('Create Product Attribute Value', ['//product-attribute-value/create','attr_id' =>$model->id], ['class' => 'btn btn-success','style' => 'background-color:#0033ff']) ?>
  </p> -->
  <h3>Values of this attribute</h3>
  <?php
    Modal::begin(['header' => 'Add new value for attribute',
	'toggleButton' => ['label' => 'Add Value','tag' =>'button','class' => 'btn btn-success','style' => 'background-color:#0033ff'],'footer' => '', ]);
  ?>
  
   <?=$this->render('//product-attribute-value/_form',['model' => new \common\models\ProductAttributeValue(['attr_id' => $model->id]) ]); ?>
  
  <?php Modal::end(); ?>
    <?= GridView::widget([
        'dataProvider' => $dataProviderAttrValues,
        'filterModel' => $searchModelAttrValues,
        'columns' => [

            'id',
            'value',
			'price_coef',
			'quantity_percent',

            [
			  'class' => 'yii\grid\ActionColumn',
			  'template' => '{update},{delete}',
			  'controller' => 'product-attribute-value',
			],
        ],
    ]); ?>
</div>

<div class="modal fade" id="atrib_info">
   <div class="modal-dialog">
       <div class="modal-content">
	      <div class="modal-header" style="background-color:#0033ff;color:#ffffff">
		    Helpful Information
		  </div>
		  <div class="modal-body">
		    <p>
			   This is page for view attribute of product.
			   You may view attribute properties and attribute values(lower).
			   Also you may create values,update attributes ...
			</p>
		  </div>
		  <div class="modal-footer" style="background-color:#cccccc">
		     <button type="button" class="btn btn-danger" id="atribhelpclose"><i class="fa fa-times" aria-hidden="true"></i></button>
		  </div>
       </div>
   </div>
</div>

<script>
  $(document).ready(function(){
	  $("#atribhelp").click(function(){
		  $("#atrib_info").modal('show');
	  });
	  $("#atribhelpclose").click(function(){
		  $("#atrib_info").modal('hide');
	  });
  });
</script>