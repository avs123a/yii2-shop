<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel backend\models\OrderSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Orders';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="order-index">

    <h1><?= Html::encode($this->title) ?> <i class="fa fa-info-circle" id="orderhelp" aria-hidden="true"></i></h1>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            'id',
            'created_at',
            'updated_at',
			'customer_type',
            'surname',
            'name',
            'email:email',
            'status',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
</div>

<div class="modal fade" id="order_list">
   <div class="modal-dialog">
       <div class="modal-content">
	      <div class="modal-header" style="background-color:#0033ff;color:#ffffff">
		    Helpful Information
		  </div>
		  <div class="modal-body">
		    <p>
			   This is page for view list of orders and
			   some details(date,customer info,email,status...).
			   You may update,view,delete information 
			   about orders.
			</p> 
			   <h4>IMPORTANT NOTE!!!</h4>
			<p>
			   information about products and full information about order you can see in View page.
			</p>
		  </div>
		  <div class="modal-footer" style="background-color:#cccccc">
		     <button type="button" class="btn btn-danger" id="orderclose"><i class="fa fa-times" aria-hidden="true"></i></button>
		  </div>
       </div>
   </div>
</div>

<script>
  $(document).ready(function(){
	  $("#orderhelp").click(function(){
		  $("#order_list").modal('show');
	  });
	  $("#orderclose").click(function(){
		  $("#order_list").modal('hide');
	  });
  });
</script>