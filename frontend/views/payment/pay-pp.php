<?php
use yii\helpers\Html;

?>
<form action="https://www.paypal.com/cgi-bin/webscr" method="post">
	<input type="hidden" name="cmd" value="_xclick">
	<input type="hidden" name="business" value="<?= $method->wallet ?>">
	<input type="hidden" name="item_name" value="Your order on market">
	<input type="hidden" name="item_number" value="Order">
	<input type="hidden" name="currency_code" value="USD">
	<input type="hidden" name="amount" value="<?= $total ?>">
	<input type="hidden" name="cancel_return" value="">
	<input type="hidden" name="return" value="">
	<input type="hidden" name="notify_url" value="">
	<input type="image" src="http://www.paypal.com/en_US/i/btn/x-click-but01.gif" name="submit" alt="Make payments with PayPal - it's fast, free and secure!">
	<?php if(\Yii::$app->user->isGuest){
	  echo Html::a('Cancel Payment',['cart/cancel', 'id' => $order['id']],['class' => 'btn btn-danger']);
  }
  else
  {
	  echo Html::a('Cancel Payment',['cabinet/archive'],['class' => 'btn btn-danger']);
  }
  ?>
</form>