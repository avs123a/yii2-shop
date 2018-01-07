<?php

namespace backend\controllers;


use Yii;
use common\models\User;
use common\models\Product;
use common\models\Order;
use yii\filters\AccessControl;
use yii\filters\VerbFilter;

class StatController extends \yii\web\Controller
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
						'matchCallback' => function ($rule, $action) {
                       return \common\models\User::isUserAdmin(Yii::$app->user->identity->username);
                   }
                    ],
                ],
            ],
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'delete' => ['POST'],
                ],
            ],
        ];
    }
    public function actionIndex()
    {
		$count_users=User::find()->count();	
	   $count_items=Product::find()->count();
	   $count_orders=Order::find()->count();
		
        return $this->render('index',['count_users'=>$count_users,'count_items'=>$count_items,'count_orders'=>$count_orders]);
    }
}