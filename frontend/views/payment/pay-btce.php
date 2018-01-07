<?php
use yii\helpers\Html;

?>
<form action="/event/btce.php" method="POST">
<p><input type="text" name="login" placeholder="Логин"></p>
<p><input type="text" name="code" placeholder="Код ваучера"></p>
<p><input type="submit" name="enter"></p>
<?php if(\Yii::$app->user->isGuest){
	  echo Html::a('Cancel Payment',['cart/cancel', 'id' => $order['id']],['class' => 'btn btn-danger']);
  }
  else
  {
	  echo Html::a('Cancel Payment',['cabinet/archive'],['class' => 'btn btn-danger']);
  }
  ?>
</form>