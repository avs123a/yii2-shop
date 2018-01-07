<?php
use yii\helpers\Html;

?>
<form method="POST" action="https://wallet.advcash.com/sci/">
<input type="hidden" name="ac_account_email" value="<?= $method->wallet ?>">
<input type="hidden" name="ac_sci_name" value="Оплата заказа">
<input type="text" name="ac_amount" placeholder="Сумма">
<input type="hidden" name="ac_currency" value="USD">
<input type="hidden" name="ac_order_id" value="<?=time()?>">
<input type="text" name="login" placeholder="Логин">
<input type="submit">
<?php if(\Yii::$app->user->isGuest){
	  echo Html::a('Cancel Payment',['cart/cancel', 'id' => $order['id']],['class' => 'btn btn-danger']);
  }
  else
  {
	  echo Html::a('Cancel Payment',['cabinet/archive'],['class' => 'btn btn-danger']);
  }
  ?>
</form>