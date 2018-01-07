<?php
namespace frontend\controllers;

use Yii;
use backend\models\Method;
use common\models\Order;

class PaymentController extends \yii\web\Controller{
   public function actionPay($order_id,$total)
   {
	$order = Order::findOne(['id' => $order_id]);
	$method = Method::findOne(['title' => $order->paysystem]);
	switch($method->title){
		case "Webmoney":
		return $this->render('pay-wm',['method' => $method,'total' => $total,'order_id' => $order_id]);
		break;
		case "Payeer":
		return $this->render('pay-pb',['method' => $method,'total' => $total,'order_id' => $order_id]);
		break;
		case "AdvCash":
		return $this->render('pay-adv',['method' => $method,'total' => $total,'order_id' => $order_id]);
		break;
		case "Blockchain":
		return $this->render('pay-btc',['method' => $method,'total' => $total,'order_id' => $order_id]);
		break;
		case "PayPal":
		return $this->render('pay-pp',['method' => $method,'total' => $total,'order_id' => $order_id]);
		break;
		case "WalletOne":
		return $this->render('pay-wo',['method' => $method,'total' => $total,'order_id' => $order_id]);
		break;
		case "Perfect Money":
		return $this->render('pay-pm',['method' => $method,'total' => $total,'order_id' => $order_id]);
		break;
		case "Interkassa":
		return $this->render('pay-ik',['method' => $method,'total' => $total,'order_id' => $order_id]);
		break;
		case "Yandex money":
		return $this->render('pay-ym',['method' => $method,'total' => $total,'order_id' => $order_id]);
		break;
		case "Qiwi":
		return $this->render('pay-qw',['method' => $method,'total' => $total,'order_id' => $order_id]);
		break;
		case "OKpay":
		return $this->render('pay-ok',['method' => $method,'total' => $total,'order_id' => $order_id]);
		break;
		case "btc-e":
		return $this->render('pay-btce',['method' => $method,'total' => $total,'order_id' => $order_id]);
		break;
	}
   }
	
}








?>