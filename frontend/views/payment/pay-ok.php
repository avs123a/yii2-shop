<?php
use yii\helpers\Html;

?>
<form action="https://www.okpay.com/process.html" method="post">
	<input type="hidden" name="ok_receiver" value="<?= $method->wallet ?>">
	<input type="hidden" name="ok_item_1_name" value="Оплата заказа">
	<input type="hidden" name="ok_currency" value="USD">
	<input type="hidden" name="ok_item_1_type" value="service">
	<input type="hidden" name="ok_item_1_price" value="<?= $total ?>">
	<input type="hidden" name="ok_return_success" value="">
	<input type="hidden" name="ok_return_fail" value="">
	<input type="hidden" name="ok_ipn" value="http://7kbsi8t64x.my.tw1.su/ipn.php">
	<input type="hidden" name="ok_invoice" value="User123">
	<input type="submit" name="submit" value="Оплатить">
	<?php if(\Yii::$app->user->isGuest){
	  echo Html::a('Отмена',['cart/cancel', 'id' => $order['id']],['class' => 'btn btn-danger']);
  }
  else
  {
	  echo Html::a('Отмена',['cabinet/archive'],['class' => 'btn btn-danger']);
  }
  ?>
</form>