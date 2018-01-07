<?php
use yii\helpers\Html;
?>
<form method="POST" action="https://merchant.webmoney.ru/lmi/payment.asp" accept-charset="windows-1251">  
  <input type="text" name="LMI_PAYMENT_AMOUNT" placeholder="<?= $total ?>">
  <input type="hidden" name="LMI_PAYMENT_DESC" value="платеж по счету">
  <input type="hidden" name="LMI_PAYMENT_NO" value="<?= "21$order_id".rand(10,20).rand(0,$order_id) ?>">
  <input type="hidden" name="LMI_PAYEE_PURSE" value="<?= $method->wallet ?>">
  <input type="text" name="login" placeholder="Логин">
  <input type="submit" class="btn btn-primary" value="Next">
  <?php if(\Yii::$app->user->isGuest){
	  echo Html::a('Cancel Payment',['cart/cancel', 'id' => $order['id']],['class' => 'btn btn-danger']);
  }
  else
  {
	  echo Html::a('Cancel Payment',['cabinet/archive'],['class' => 'btn btn-danger']);
  }
  ?>
</form>