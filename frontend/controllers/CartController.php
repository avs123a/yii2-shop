<?php

namespace frontend\controllers;

use common\models\Order;
use common\models\OrderItem;
use common\models\Product;
use yz\shoppingcart\ShoppingCart;

class CartController extends \yii\web\Controller
{
    public function actionAdd($id)
    {
        $product = Product::findOne($id);
        if ($product) {
			$attr = \common\models\ProductAttributes::find()->where(['product_id' => $id])->all();
			foreach($attr as $prod_attr)
			{
				$prid = $prod_attr->id;
				$atrvalue = \common\models\ProductAttributeValue::findOne(['attr_id' => $prod_attr->id , 'value' => \Yii::$app->request->post($prod_attr->attr_title)]);
				\Yii::$app->session->set("A_$prid" ,\Yii::$app->request->post($prod_attr->attr_title));
				\Yii::$app->session->set("P_$prid" ,$atrvalue->price_coef);
				\Yii::$app->session->set("Q_$prid" ,$atrvalue->quantity_percent);
			}
			\Yii::$app->cart->put($product,$quantity=\Yii::$app->request->post('quant'));
            return $this->goBack();
        }
    }

    public function actionList()
    {
        /* @var $cart ShoppingCart */
        $cart = \Yii::$app->cart;

        $products = $cart->getPositions();
        $total = $cart->getCost();

        return $this->render('list', [
           'products' => $products,
		   //'product_attr_val' => $product_attr_val,
           'total' => $total,
        ]);
    }

    public function actionRemove($id)
    {
        $product = Product::findOne($id);
        if ($product) {
            \Yii::$app->cart->remove($product);
            $this->redirect(['cart/list']);
			$atr2 = \common\models\ProductAttributes::find()->where(['product_id' => $id])->all();
			foreach($atr2 as $attr2){
				$atrid2 = $attr2->id;
			     \Yii::$app->session->remove("A_$atrid2");
				 \Yii::$app->session->remove("P_$atrid2");
				 \Yii::$app->session->remove("Q_$atrid2");
			}
        }
    }

    public function actionUpdate($id, $quantity)
    {
        $product = Product::findOne($id);
        if ($product) {
            \Yii::$app->cart->update($product, $quantity);
            $this->redirect(['cart/list']);
        }
    }
	
    public function actionOrder()
    {
        $order = new Order();
		/*if(!\Yii::$app->user->isGuest)
		{
			$order->customer_type = self::Registered;
			
			$user = \common\models\User::findOne(['username' => \Yii::$app->user->identity->username]);
			if($user->surname != null)
			{
			$order->surname = $user->surname;
			$order->name = $user->name;
			$order->country = $user->country;
			$order->region = $user->region;
			$order->city = $user->city;
			$order->address = $user->address;
			$order->zip_code = $user->zip_code;
			$order->phone = $user->phone;
			$order->email = $user->email;
			//$order-> 
			}
			else
			{
				\Yii::$app->session->addFlash('error','Fill your profile for creating orders fast and using other advantages of having account!!!');
				return $this->redirect(['//cabinet/profile']);
			}
		} */

        /* @var $cart ShoppingCart */
        $cart = \Yii::$app->cart;

        /* @var $products Product[] */
        $products = $cart->getPositions();
        $total = $cart->getCost();

        if ($order->load(\Yii::$app->request->post()) && $order->validate()) {
            $transaction = $order->getDb()->beginTransaction();
            $order->save(false);

            foreach($products as $product) {
                $orderItem = new OrderItem();
                $orderItem->order_id = $order->id;
                $orderItem->title = $product->title;
                $orderItem->price = $product->getPrice();
                $orderItem->product_id = $product->id;
                $orderItem->quantity = $product->getQuantity();
				$product_attrib2 = \common\models\ProductAttributes::find()->where(['product_id' => $product->id])->all();
				if($orderItem->save(false)){
				  foreach($product_attrib2 as $product_attr2){
				   $orderItemAttr = new \common\models\OrderItemsAttribute(/* ['item_id' => $item->id] */);
				   $orderItemAttr->item_id = $orderItem->id;
				   $orderItemAttr->attr_title = $product_attr2->attr_title;
				   $atrid1 = $product_attr2->id;
				   $orderItemAttr->attr_value = \Yii::$app->session->get("A_$atrid1");
				   if(!$orderItemAttr->save(false)) {
					   \Yii::$app->session->addFlash('error', 'Cannot set choosen product characteristics. Please contact us.');
				   }
				   \Yii::$app->session->remove("A_$atrid1");
				  }
				}
                if (!$orderItem->save(false)) {
                    $transaction->rollBack();
                    \Yii::$app->session->addFlash('error', 'Cannot place your order. Please contact us.');
                    return $this->redirect('catalog/list');
                }
            }

            $transaction->commit();
            \Yii::$app->cart->removeAll();
			
			//$product_attr_val = null;
            if($order['paysystem']!='Pay to courier' && $order['paysystem']!='Pay in office')
			{
				\Yii::$app->session->addFlash('success', 'Please,pay this order by choosen payment method.');
				return $this->redirect(['//payment/pay', 'order_id' => $order->id, 'total' => $total]);
			}
			else
			{
               \Yii::$app->session->addFlash('success', 'Thanks for your order. We\'ll contact you soon.');
               $order->sendEmail();
               return $this->redirect('catalog/list');
			}
        }

        return $this->render('order', [
            'order' => $order,
            'products' => $products,
            'total' => $total,
        ]);
    }
	
	public function actionCancel($id)
	{
		$order = Order::findOne(['id' => $id]);
		$items = OrderItem::find()->where(['order_id' => $id])->all();
		foreach($items as $item)
		{
		  $attr = \common\models\OrderItemsAttribute::find()->where(['item_id' => $item->id])->all();
		  foreach($attr as $itematr)
		  {
		      $itematr->delete();
		  }
		  $item->delete();
		}
		if($order->delete()){
			\Yii::$app->session->addFlash('success','You cancelled your order');
			if(! \Yii::$app->user->isGuest){
			  return $this->redirect(['//cabinet/archive']);
			}
			else{
			  return $this->redirect(['//catalog/list']);  
			}
		}
		else{
		    \Yii::$app->session->addFlash('error','Error.You not cancelled your order.Please,contact us.');
		    if(! \Yii::$app->user->isGuest){
			  return $this->redirect(['//cabinet/archive']);
			}
			else{
			  return $this->redirect(['//catalog/list']);  
			}
		}
	}
}
