<?php

namespace backend\controllers;

use Yii;
use common\models\ProductAttributeValue;
use backend\models\ProductAttributeValueSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\filters\AccessControl;

/**
 * ProductAttributeValueController implements the CRUD actions for ProductAttributeValue model.
 */
class ProductAttributeValueController extends Controller
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
	
	
	public function actionCreate($attr_id)
    {
        $model = new ProductAttributeValue();
		$model->attr_id = $attr_id;
        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['//product-attributes/view','id' =>$model->attr_id]);
        } else {
            \Yii::$app->session->addFlash('error', 'Adding attribute value was failed.');
			return $this->redirect(['//product-attributes/view','id' =>$model->attr_id]);
        }
    }
	
	
	public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['//product-attributes/view','id' =>$model->attr_id]);
        } else {
            return $this->render('update', [
                'model' => $model,
            ]);
        }
    }
	

    public function actionDelete($id)
    {
		$atrid=$this->findModel($id)->attr_id;
        $this->findModel($id)->delete();

        return $this->redirect(['//product-attributes/view','id' =>$atrid]);
    }

    protected function findModel($id)
    {
        if (($model = ProductAttributeValue::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
