<?php
use yii\helpers\Html;

$this->title = 'Personal cabinet';
?>
<div id="profile1">
 <div class="row">
  <div class="col-xs-3" style="border:1px">
    Username:
  </div>
  <div class="col-xs-3" style="border:1px">
    Email:
  </div>
 </div>
 <div class="row">
  <div class="col-xs-3" style="border:1px">
    <?= $user->username ?>
  </div>
  <div class="col-xs-3" style="border:1px">
    <?= $user->email ?>
  </div>
 </div>
</div>

<div class="row">
 <nav class="navbar-default" >
  <ul class="nav navbar-nav" style="background-color:#ccffff">
    <li><?= Html::a('Cabinet info',['cabinet/index']) ?></li>
	<li><?= Html::a('My Profile',['cabinet/profile-view']) ?></li>
	<li><?= Html::a('My Orders',['cabinet/archive']) ?></li>
  </ul>
 </nav>
</div>
<h2>Welcome, <?= \Yii::$app->user->identity->username ?></h3><br>
<div id="stats1">
 <h3>Short statistics</h3>
 <div class="row">
  <div class="col-xs-3" style="border:1px">
    Orders:&nbsp;<strong><?= $orders ?></strong>
  </div>
  <div class="col-xs-3" style="border:1px">
    Not paid orders:&nbsp;<strong><?= $unpaid_orders ?></strong>
  </div>
</div>
</div>
<script>
  $(document).ready(function(){
	  alert("This is your personal cabinet.You may update your profile,change email, view  your order history");
  });
</script>
