<?php
use yii\helpers\Html;

?>
<form name="payment" method="post" action="https://sci.interkassa.com/" enctype="utf-8">
	<input type="hidden" name="ik_co_id" value="<?= $method->wmid_or_merchant ?>">
	<input type="hidden" name="ik_pm_no" value="<?=time()?>">
	<p><input type="text" name="ik_am" placeholder="<?= $total ?>"></p>
	<p><input type="text" name="ik_x_login" placeholder="Логин"></p>
	<input type="hidden" name="ik_cur" value="USD">
	<input type="hidden" name="ik_desc" value="Заказ на демонстрационном ИМ">
    <p><input type="submit" value="Оплатить"></p>
	<?php if(\Yii::$app->user->isGuest){
	  echo Html::a('Отмена',['cart/cancel', 'id' => $order['id']],['class' => 'btn btn-danger']);
  }
  else
  {
	  echo Html::a('Отмена',['cabinet/archive'],['class' => 'btn btn-danger']);
  }
  ?>
</form>