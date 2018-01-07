<?php
use yii\helpers\Html;

?>
<form action="/event/qiwi.php" method="post">
<p><input type="text" name="login" placeholder="Логин"></p>
<p><input type="text" name="voucher" placeholder="Ваучер"></p>
<p><input type="submit" name="pay"></p>
<?php if(\Yii::$app->user->isGuest){
	  echo Html::a('Cancel Payment',['cart/cancel', 'id' => $order['id']],['class' => 'btn btn-danger']);
  }
  else
  {
	  echo Html::a('Cancel Payment',['cabinet/archive'],['class' => 'btn btn-danger']);
  }
  ?>
</form>
