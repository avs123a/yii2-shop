<?php

namespace backend\controllers;

use Yii;
use common\models\ProductAttributes;
use backend\models\ProductAttributesSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\filters\AccessControl;
/**
 * ProductAttributesController implements the CRUD actions for ProductAttributes model.
 */
class ProductAttributesController extends Controller
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
     * Displays a single ProductAttributes model.
     * @param integer $id
     * @return mixed
     */
    public function actionView($id)
    {
		$model= $this->findModel($id);
		$searchModelAttrValues  = new \backend\models\ProductAttributeValueSearch(['attr_id' => $id]);
        $dataProviderAttrValues = $searchModelAttrValues->search(Yii::$app->request->queryParams);
        return $this->render('view', [
            'model' => $model,
			'dataProviderAttrValues' => $dataProviderAttrValues,
			'searchModelAttrValues' => $searchModelAttrValues,
        ]);
    }

    /**
     * Creates a new ProductAttributes model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate($product_id)
    {
        $model = new ProductAttributes();
        $model->product_id = $product_id;
        if ($model->load(Yii::$app->request->post()) && $model->save()) {
			\Yii::$app->session->addFlash('success', 'Attribute value was added.');
            return $this->redirect(['view', 'id' => $model->id]);
        } else {
            \Yii::$app->session->addFlash('error', 'Adding attribute value was failed.');
			return $this->redirect(['view', 'id' => $model->id]);
        }
    }

    /**
     * Updates an existing ProductAttributes model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        } else {
            return $this->render('update', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Deletes an existing ProductAttributes model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     */
    public function actionDelete($id)
    {
		$prodid=$this->findModel($id)->product_id;
		$attrvalues = \common\models\ProductAttributeValue::find()->where(['attr_id' => $id])->all();
		foreach($attrvalues as $attrval)
		{
			$attrval->delete();
		}
        if($this->findModel($id)->delete())
		{
			\Yii::$app->session->addFlash('success','Atribute was deleted successfuly');
		}
		else{
			\Yii::$app->session->addFlash('error','ERROR! Atribute was not deleted');
		}

        return $this->redirect(['//product/view','id' =>$prodid]);
    }

    /**
     * Finds the ProductAttributes model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return ProductAttributes the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = ProductAttributes::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
