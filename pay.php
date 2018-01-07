<?php
if(isset($_POST['payonline']))
{
	$orderid=$_POST['orderid'];
	$paysyst=$_POST['ps'];
}
$mysqli=new mysqli("localhost","root","","trade");
$requiz=$mysqli->query("select wallet as wlt ,wmid_or_merchant as wom from method where title=$paysyst");
$items=$mysqli->query("select* from order_item where order_id=$orderid");
$total=null;

?>
<!DOCTYPE HTML>
<html>
 <head>
    <title>Payment Page</title>
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">
	<style>
	h1{
		margin:0px !important;
		padding:0px !important;
	}
	
	</style>
 </head>
 <body style="background-color:#00ffff">
    <h1 style="text-align:center;background-color:#0033ff;color:#ffffff">Paying for item</h1>
    <div class="row" height="30px" style="text-align:center;font-size:14px;">
	 <?php $item=mysqli_fetch_assoc($items) ?>
	   <div class="col-xs-3">
	     <h3>Product</h3>
		 <p><?=$item['title'] ?></p>
	   </div>
	   <div class="col-xs-3">
	     <h3>Price</h3>
		 <p>$<?=$item['price'] ?></p>
	   </div>
	   <div class="col-xs-3">
	     <h3>Quantity</h3>
		 <p><?=$item['quantity'] ?></p>
	   </div>
	   <div class="col-xs-3">
	     <h3>Total</h3>
		 <p>$<?= ($item['price']*$item['quantity']);$total=$item['price']*$item['quantity'] ?></p>
	   </div>
	</div>
	<h3 style="text-align:center">You selected next payment method : <?= $paysyst ?></h3>
<?php
      $reqz=mysqli_fetch_row($requiz);
	  $pw=$reqz['wlt'];
	  $mc=$reqz['wom'];
   switch($paysyst)
   {
	   case "Webmoney":
echo '<form method="POST" action="https://merchant.webmoney.ru/lmi/payment.asp" accept-charset="windows-1251">  
  <input type="hidden" name="LMI_PAYMENT_AMOUNT" value="$total">
  <input type="hidden" name="LMI_PAYMENT_DESC" value="Оплата товара в интернет-магазине">
  <input type="hidden" name="LMI_PAYMENT_NO" value="$orderid">
  <input type="hidden" name="LMI_PAYEE_PURSE" value="$pw">
  <input type="text" name="login" placeholder="Логин">
  <input type="submit" value="Next">
</form>'; break;
       case "Payeer":  
	  break; 
	   case "AdvCash": 
echo '<form method="POST" action="https://wallet.advcash.com/sci/">
<input type="hidden" name="ac_account_email" value="$pw">
<input type="hidden" name="ac_sci_name" value="PHP">
<input type="text" name="ac_amount" placeholder="$total">
<input type="hidden" name="ac_currency" value="USD">
<input type="hidden" name="ac_order_id" value="<?=time()?>">
<input type="text" name="login" placeholder="Логин">
<input type="submit">
</form>';
	   break; 
	   case "Blockchain": 
	   break; 
	   case "PayPal": 
echo '<form action="https://www.paypal.com/cgi-bin/webscr" method="post">
	<input type="hidden" name="cmd" value="_xclick">
	<input type="hidden" name="business" value="$pw">
	<input type="hidden" name="item_name" value="Описание товара или услуги">
	<input type="hidden" name="item_number" value="User123">
	<input type="hidden" name="currency_code" value="USD">
	<input type="hidden" name="amount" value="$total">
	<input type="hidden" name="cancel_return" value="http://7kbsi8t64x.my.tw1.su">
	<input type="hidden" name="return" value="http://7kbsi8t64x.my.tw1.su">
	<input type="hidden" name="notify_url" value="http://7kbsi8t64x.my.tw1.su/ipn.php">
	<input type="image" src="http://www.paypal.com/en_US/i/btn/x-click-but01.gif" name="submit" alt="Make payments with PayPal - it_s fast, free and secure!">
</form>';	   
	   break; 
	   case "WalletOne":   
	   break; 
	   case "Perfect Money":  
echo '<form action="https://perfectmoney.is/api/step1.asp" method="POST">

    <input type="hidden" name="PAYEE_ACCOUNT" value="$pw">
    <input type="hidden" name="PAYEE_NAME" value="$mc">
    <input type="hidden" name="PAYMENT_UNITS" value="USD">
    <input type="hidden" name="STATUS_URL" value="http://payment.webtm.ru/event/perfectmoney.php">
    <input type="hidden" name="PAYMENT_URL" value="http://payment.webtm.ru/success.php">
    <input type="hidden" name="NOPAYMENT_URL" value="http://payment.webtm.ru/error.php">
    <input type="text" name="PAYMENT_ID" placeholder="Логин">
    <input type="text" name="PAYMENT_AMOUNT" placeholder="$total">
    <input type="submit" name="PAYMENT_METHOD" value="Next">

</form>';	   
	   break; 
	   case "Interkassa":
	   echo '<form name="payment" method="post" action="https://sci.interkassa.com/" enctype="utf-8">
	<input type="hidden" name="ik_co_id" value="$mc">
	<input type="hidden" name="ik_pm_no" value="<?=time()?>">
	<p><input type="hidden" name="ik_am" placeholder="$total*60"></p>
	<p><input type="text" name="ik_x_login" placeholder="Логин"></p>
	<input type="hidden" name="ik_cur" value="RUB">
	<input type="hidden" name="ik_desc" value="Продажа змей">
    <p><input type="submit" value="Оплатить"></p>
</form>';
	   break; 
	   case "Yandex money":  
	   echo '<form method="POST" action="https://money.yandex.ru/quickpay/confirm.xml"> 
    <input type="hidden" name="receiver" value="$pw"> 
    <input type="hidden" name="quickpay-form" value="$mc"> 
    <input type="hidden" name="targets" value="$"> 
    <input type="hidden" name="paymentType" value="PC">
    <input type="hidden" name="successURL" value="http://mymarket/frontend/web/index.php">
    <input type="text" name="label" placeholder="Логин покупателя"> 
    <input type="text" name="sum" placeholder="$total*60">
    <input type="submit" value="Next"> 
</form>';
	   break; 
	   case "Qiwi":   
	   break; 
	   case "OKpay":   
	   echo '<form action="https://www.okpay.com/process.html" method="post">
	<input type="hidden" name="ok_receiver" value="$pw">
	<input type="hidden" name="ok_item_1_name" value="Описание">
	<input type="hidden" name="ok_currency" value="USD">
	<input type="hidden" name="ok_item_1_type" value="service">
	<input type="hidden" name="ok_item_1_price" value="$total">
	<input type="hidden" name="ok_return_success" value="http://7kbsi8t64x.my.tw1.su">
	<input type="hidden" name="ok_return_fail" value="http://7kbsi8t64x.my.tw1.su">
	<input type="hidden" name="ok_ipn" value="http://7kbsi8t64x.my.tw1.su/ipn.php">
	<input type="hidden" name="ok_invoice" value="User123">
	<input type="submit" name="submit" value="Оплатить">
</form>';
	   break; 
	   case "btc-e":  
       break;
}
?>

    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js" integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" crossorigin="anonymous"></script>
 </body>
</html>