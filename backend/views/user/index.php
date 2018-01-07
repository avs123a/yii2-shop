<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel backend\models\UserSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Users';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="user-index">

    <h1><?= Html::encode($this->title) ?> <i class="fa fa-info-circle" id="acchelp" aria-hidden="true"></i></h1>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            'id',
            'username',
            'auth_key',
            'password_reset_token',
            // 'email:email',
            // 'status',
            // 'created_at',
            // 'updated_at',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
</div>

<div class="modal fade" id="accounts_list">
   <div class="modal-dialog">
       <div class="modal-content">
	      <div class="modal-header" style="background-color:#0033ff;color:#ffffff">
		    Helpful Information
		  </div>
		  <div class="modal-body">
		    <p>
			   This is page for view users.
			   You may view user's info,update(change status - active/banned) and delete.
			</p>
		  </div>
		  <div class="modal-footer" style="background-color:#cccccc">
		     <button type="button" class="btn btn-danger" id="acclose"><i class="fa fa-times" aria-hidden="true"></i></button>
		  </div>
       </div>
   </div>
</div>

<script>
  $(document).ready(function(){
	  $("#acchelp").click(function(){
		  $("#accounts_list").modal('show');
	  });
	  $("#acclose").click(function(){
		  $("#accounts_list").modal('hide');
	  });
  });
</script>