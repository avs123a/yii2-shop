<?php

namespace backend\controllers;

use common\models\Category;
use Yii;
use common\models\Product;
use backend\models\ProductSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\filters\AccessControl;

/**
 * ProductController implements the CRUD actions for Product model.
 */
class ProductController extends Controller
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
                    'delete' => ['post'],
                ],
            ],
        ];
    }

    /**
     * Lists all Product models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new ProductSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Product model.
     * @param integer $id
     * @return mixed
     */
    public function actionView($id)
    {
		$model = $this->findModel($id);
		$searchModelAttr  = new \backend\models\ProductAttributesSearch(['product_id' => $id]);
        $dataProviderAttr = $searchModelAttr->search(Yii::$app->request->queryParams);
		$searchModelFeedBack = new \backend\models\ProductFeedbackSearch(['product_id' => $id]);
		$dataProviderFeedBack = $searchModelFeedBack->search(Yii::$app->request->queryParams);
        return $this->render('view', [
            'model' => $model,
			'dataProviderAttr' => $dataProviderAttr,
			'searchModelAttr' => $searchModelAttr,
			'searchModelFeedBack' => $searchModelFeedBack,
			'dataProviderFeedBack' => $dataProviderFeedBack,
        ]);
    }

    /**
     * Creates a new Product model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $categories = Category::find()->all();
        $model = new Product();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        } else {
            return $this->render('create', [
                'model' => $model,
                'categories' => $categories,
            ]);
        }
    }

    /**
     * Updates an existing Product model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate($id)
    {
        $categories = Category::find()->all();
        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        } else {
            return $this->render('update', [
                'model' => $model,
                'categories' => $categories,
            ]);
        }
    }

    /**
     * Deletes an existing Product model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     */
    public function actionDelete($id)
    {
		$prodattributes = \common\models\ProductAttributes::find()->where(['product_id' => $id])->all();
		foreach($prodattributes as $atr)
		{
			$atrvalues = \common\models\ProductAttributeValue::find()->where(['attr_id' => $atr->id])->all();
			foreach($$atrvalues as $atrval)
		    {
			    $atrval->delete();
		    }
			$atr->delete();
		}
		$prodfeedback = \common\models\ProductFeedback::find()->where(['product_id' => $id])->all();
		foreach($prodfeedback as $fdb)
		{
			$fdb->delete();
		}
        if($this->findModel($id)->delete())
		{
			\Yii::$app->session->addFlash('success','Product was deleted successfully');
		}
		else
		{
			\Yii::$app->session->addFlash('error','Error! Product was not deleted');
		}

        return $this->redirect(['index']);
    }

    /**
     * Finds the Product model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Product the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Product::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
