<?php
use yii\helpers\Html;

?>
<form action="https://perfectmoney.is/api/step1.asp" method="POST">

    <input type="hidden" name="PAYEE_ACCOUNT" value="<?= $method->wallet ?>">
    <input type="hidden" name="PAYEE_NAME" value="ОПИСАНИЕ МАГАЗИНА">
    <input type="hidden" name="PAYMENT_UNITS" value="USD">
    <input type="hidden" name="STATUS_URL" value="">
    <input type="hidden" name="PAYMENT_URL" value="">
    <input type="hidden" name="NOPAYMENT_URL" value="">
    <input type="text" name="PAYMENT_ID" placeholder="Логин">
    <input type="text" name="PAYMENT_AMOUNT" placeholder="<?= $total ?>">
    <input type="submit" name="PAYMENT_METHOD" value="Оплатить">
	<?php if(\Yii::$app->user->isGuest){
	  echo Html::a('Отмена',['cart/cancel', 'id' => $order['id']],['class' => 'btn btn-danger']);
  }
  else
  {
	  echo Html::a('Отмена',['cabinet/archive'],['class' => 'btn btn-danger']);
  }
  ?>

</form>