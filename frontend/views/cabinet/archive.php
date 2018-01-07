<?php
use yii\helpers\Html;

$this->title = 'My Orders ';
?>
<style>
  th{
	  border:1px solid black !important;
  }
  td{
	  border:1px solid black !important;
  }
</style>
<div class="row">
 <nav class="navbar-default" >
  <ul class="nav navbar-nav" style="background-color:#ccffff">
    <li><?= Html::a('Cabinet info',['cabinet/index']) ?></li>
	<li><?= Html::a('My Profile',['cabinet/profile-view']) ?></li>
	<li><?= Html::a('My Orders',['cabinet/archive']) ?></li>
  </ul>
 </nav>
</div>
<h2>Your order history</h3>
<div>
 <table class="col-xs-8">
    <tr>
	  <th>ID</th>
	  <th>Products</th>
	  <th>Total cost</th>
	  <th>Payment</th>
	  <th>Status</th>
	  <th></th>
	</tr>
  <?php foreach($model as $order): ?>
    <tr>
	  <td><?= $order['id'] ?></td>
	  <td><?php foreach($order_items[$order['id']] as $item): ?>
	  <?= $item['title'] ?>&nbsp;<?= "(".$item['quantity'].")" ?>&nbsp;<?= "price: $".$item['price'] ?>
	  <?php $total_cost += ($item['price']*$item['quantity']);
	  endforeach;
	  ?></td>
	  <td>$<?= $total_cost ?></td>
	  <td><?= $order['paysystem'] ?></td>
	  <td><?= $order['status'] ?></td>
	  <?php if(($order['paysystem']!='Pay to courier' && $order['paysystem']!='Pay in office') && ($order['status']=='New' || $order['status']=='Not Paid')): ?>
	  <td>
	    <?= Html::a('Pay',['payment/pay', 'order_id' => $order['id'], 'total' => $total_cost],['class' => 'btn btn-primary']) ?>
		<?= Html::a('Cancel Order',['cart/cancel', 'id' => $order['id']],['class' => 'btn btn-danger']) ?>
      </td>
	  <?php endif; ?>
	</tr>
  <?php $total_cost = 0;endforeach; ?>
 </table>
</div>