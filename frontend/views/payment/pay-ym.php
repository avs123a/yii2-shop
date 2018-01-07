<?php
use yii\helpers\Html;

?>
<form method="POST" action="https://money.yandex.ru/quickpay/confirm.xml"> 
    <input type="hidden" name="receiver" value="<?= $method->wallet ?>"> 
    <input type="hidden" name="quickpay-form" value="shop"> 
    <input type="hidden" name="targets" value="Заказ на демонстрационном ИМ"> 
    <input type="hidden" name="paymentType" value="PC">
    <input type="hidden" name="successURL" value="">
    <input type="text" name="label" placeholder="Логин покупателя"> 
    <input type="text" name="sum" placeholder="<?= $total*66 ?>">
    <input type="submit" value="Оплатить"> 
	<?php if(\Yii::$app->user->isGuest){
	  echo Html::a('Отмена',['cart/cancel', 'id' => $order['id']],['class' => 'btn btn-danger']);
  }
  else
  {
	  echo Html::a('Отмена',['cabinet/archive'],['class' => 'btn btn-danger']);
  }
  ?>
</form>