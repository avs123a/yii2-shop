<?php

use yii\helpers\Html;
use yii\widgets\DetailView;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $model backend\models\Order */

$this->title = $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Orders', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="order-view">

    <h1>Order №<?= Html::encode($this->title) ?> <i class="fa fa-info-circle" id="orderinfohelp" aria-hidden="true"></i></h1>

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
            'created_at',
            'updated_at',
			'customer_type',
            'surname',
            'name',
            'country',
            'region',
            'city',
            'address:ntext',
			'zip_code',
            'phone',
            'email:email',
            'paysystem',
            'wallet',
            'notes:ntext',
            'status',
        ],
    ]) ?>
  <hr>
	<h3>Items To This Order</h3>
	<?= GridView::widget([
        'dataProvider' => $dataProviderItems,
        'filterModel' => $searchModelItems,
        'columns' => [
            'id',
           // 'order_id',
            'title',
            'price',
            'product_id',
            'quantity',

            [
			   'class' => 'yii\grid\ActionColumn',
			   //'template' =>'{update},{delete}',
			   'controller' => 'order-item',
			],
        ],
    ]); ?>
</div>

<div class="modal fade" id="order_view">
   <div class="modal-dialog">
       <div class="modal-content">
	      <div class="modal-header" style="background-color:#0033ff;color:#ffffff">
		    Helpful Information
		  </div>
		  <div class="modal-body">
		    <p>
			   This is page for view full details of choosen order
			   (personal data of customer,address,list of items...)
			</p>
		  </div>
		  <div class="modal-footer" style="background-color:#cccccc">
		     <button type="button" class="btn btn-danger" id="orderviewclose"><i class="fa fa-times" aria-hidden="true"></i></button>
		  </div>
       </div>
   </div>
</div>

<script>
  $(document).ready(function(){
	  $("#orderinfohelp").click(function(){
		  $("#order_view").modal('show');
	  });
	  $("#orderviewclose").click(function(){
		  $("#order_view").modal('hide');
	  });
  });
</script>