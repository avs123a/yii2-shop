<?php
use yii\helpers\Html;
$m_shop = $method->wmid_or_merchant;
$m_orderid = "21$order_id".rand(20,30).rand(0,$order_id);
$m_amount = $total;
$m_curr = 'USD';
$m_desc = base64_encode('Test');
$m_key = 'Ваш ключ';

$arHash = array(
	$m_shop,
	$m_orderid,
	$m_amount,
	$m_curr,
	$m_desc,
	$m_key
);
$sign = strtoupper(hash('sha256', implode(':', $arHash)));
?>

<form method="GET" action="https://payeer.com/merchant/">
<input type="hidden" name="m_shop" value="<?=$m_shop?>">
<input type="hidden" name="m_orderid" value="<?=$m_orderid?>">
<input type="hidden" name="m_amount" value="<?=$m_amount?>">
<input type="hidden" name="m_curr" value="<?=$m_curr?>">
<input type="hidden" name="m_desc" value="<?=$m_desc?>">
<input type="hidden" name="m_sign" value="<?=$sign?>">
<input type="text" name="login" placeholder="Логин">


<input type="submit" name="m_process" value="send" />
<?php if(\Yii::$app->user->isGuest){
	  echo Html::a('Отмена',['cart/cancel', 'id' => $order['id']],['class' => 'btn btn-danger']);
  }
  else
  {
	  echo Html::a('Отмена',['cabinet/archive'],['class' => 'btn btn-danger']);
  }
  ?>
</form>
