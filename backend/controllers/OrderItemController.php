<?php

namespace backend\controllers;

use Yii;
use common\models\OrderItem;
use backend\models\OrderItemSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\filters\AccessControl;
/**
 * OrderItemController implements the CRUD actions for OrderItem model.
 */
class OrderItemController extends Controller
{
    /**
     * @inheritdoc
     */
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


    /**
     * Displays a single OrderItem model.
     * @param integer $id
     * @return mixed
     */
	public function actionView($id)
    {
		$model= $this->findModel($id);
		$searchModelOrderItemAttr  = new \backend\models\OrderItemsAttributeSearch(['item_id' => $id]);
        $dataProviderOrderItemAttr = $searchModelOrderItemAttr->search(Yii::$app->request->queryParams);
		
		
        return $this->render('view', [
            'model' => $model,
			'dataProviderOrderItemAttr' => $dataProviderOrderItemAttr,
			'searchModelOrderItemAttr' => $searchModelOrderItemAttr,			
        ]);
    }
	 
	 
	 

    /**
     * Creates a new OrderItem model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    

    /**
     * Updates an existing OrderItem model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['//order/view', 'id' => $model->order_id]);
        } else {
            return $this->render('update', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Deletes an existing OrderItem model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     */
    public function actionDelete($id)
    {
		$orderid = $this->findModel($id)->order_id;
        $this->findModel($id)->delete();

        return $this->redirect(['//order/view','id' => $orderid]);
    }

    /**
     * Finds the OrderItem model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return OrderItem the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = OrderItem::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
