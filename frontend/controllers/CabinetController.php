<?php
namespace frontend\controllers;

use common\models\User;
use common\models\Order;
use yii\web\Controller;
use yii\filters\AccessControl;

class CabinetController extends Controller
{
	public function behaviors()
    {
        return [
		    'access' => [
                'class' => AccessControl::className(),
                'rules' => [
                    [
                        'allow' => true,
                        'roles' => ['@'],
                    ],
                ],
            ],
        ];
    }
	//main cabinet page
	public function actionIndex()
	{
		$user = User::findOne(['username' => \Yii::$app->user->identity->username]);
		$orders = Order::find()->where(['email' => $user->email])->count();
		$unpaid_orders = Order::find()->where(['and',['email' => $user->email],['not',['status'=>['Cancelled','Paid','In Shipping','Done']]]])->count();
		return $this->render('index',[
		   'user' => $user,
		   'orders' => $orders,
		   'unpaid_orders' => $unpaid_orders
		]);
	}
	//view/update profile
	public function actionProfile()
	{
	    $model = User::findOne(['username' => \Yii::$app->user->identity->username]);
		if ($model->load(\Yii::$app->request->post()) && $model->save()) {
			\Yii::$app->session->addFlash('success','You updated your profile succesfuly');
            return $this->redirect(['cabinet/profile-view']);
        } else {
            return $this->render('profile', [
                'model' => $model,
            ]);
        }
	
	
	}
	
	public function actionProfileView()
	{
		$model = User::findOne(['username' => \Yii::$app->user->identity->username]);
		if($new_email = \Yii::$app->request->post('email_new')){
			$model->email = $new_email;
			$model->save();
		}
		return $this->render('profile-view',['model' => $model]);
	}
	//user order archive
	public function actionArchive()
	{
		$user = User::findOne(['username' => \Yii::$app->user->identity->username]);
		$order_items = null;
		$model = Order::find()->where(['email' => $user->email])->asArray()->all();
		foreach($model as $order){
		$order_items[$order['id']] = \common\models\OrderItem::find()->where(['order_id'=>$order['id']])->asArray()->all();
		}
		return $this->render('archive',['model' => $model, 'order_items' => $order_items]);
	}
	//
	
	
}
?>