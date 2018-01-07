<?php

namespace frontend\controllers;

use common\models\Category;
use common\models\Product;
use yii\data\ActiveDataProvider;
use yii\helpers\Url;

class CatalogController extends \yii\web\Controller
{
    public function beforeAction($action)
    {
        if (parent::beforeAction($action)) {
            Url::remember();
            return true;
        } else {
            return false;
        }
    }

    public function actionList($id = null)
    {
        /** @var Category $category */
        $category = null;
        $search = null;
        $categories = Category::find()->indexBy('id')->orderBy('id')->all();

        $productsQuery = Product::find()->where(['not',['instore'=>'0']])->indexBy('id');
        if ($id !== null && isset($categories[$id])) {
            $category = $categories[$id];
            $productsQuery->where(['category_id' => $this->getCategoryIds($categories, $id)])->andFilterWhere(['not',['instore'=>'0']])->indexBy('id');
        }
		
		//global search
		if(\Yii::$app->request->get('searchbutton')){
			$gsearch=\Yii::$app->request->get('gsearch');
			$productsQuery->andFilterWhere(['like','title',$gsearch])->orFilterWhere(['like','description',$gsearch]);
		}
		
		//filters
		if(!\Yii::$app->request->get('resetfilters')){
		  if(\Yii::$app->request->get('addfilters')){
			if($minprice=\Yii::$app->request->get('minprice')){
			   $productsQuery->andFilterWhere(['>=','price',$minprice]);
			}
			if($maxprice=\Yii::$app->request->get('maxprice')){
			   $productsQuery->andFilterWhere(['<=','price',$maxprice]);
			}
			if($sort=\Yii::$app->request->get('sort')){
			  switch($sort)
			  {
				case "default" : $productsQuery->orderBy('id');
				break;
				case "price_high" : $productsQuery->orderBy('price DESC');
				break;
				case "price_low" : $productsQuery->orderBy('price');
				break;
			  }
			}
		  }
		}
		
		
		

        $productsDataProvider = new ActiveDataProvider([
            'query' => $productsQuery->andFilterWhere(['not',['instore'=>'0']]),
            'pagination' => [
                'pageSize' => 9,
            ],
        ]);

        return $this->render('list', [
            'category' => $category,
            'menuItems' => $this->getMenuItems($categories, isset($category->id) ? $category->id : null),
            'productsDataProvider' => $productsDataProvider,
			
        ]);
    }

    public function actionView($id)
    {
		$model=$this->findModel($id);
		$attr=\common\models\ProductAttributes::find()->where(['product_id' => $id])->all();
		$query = \common\models\ProductFeedback::find()->where(['product_id' => $id]);
		$pagination = new \yii\data\Pagination(['defaultPageSize' => 5 , 'totalCount' => $query->count(),]);
		$fdb = $query->indexBy('id')->orderBy('id DESC')->offset($pagination->offset)->limit($pagination->limit)->asArray()->all();
		
		//comments
		  if(\Yii::$app->request->get('add_comment'))
		  {
			  $comment = new \common\models\ProductFeedback();
			  $comment->product_id = $id;
			  $comment->id_user = \Yii::$app->user->identity->username;
			  $comment->comment = \Yii::$app->request->get('newcomment');
			  if($comment->save())
			  {
				  \Yii::$app->session->addFlash('success', 'Thank you for comment.');
				  return $this->redirect(['view','id' => $id]);
			  }
			  else
			  {
				  \Yii::$app->session->addFlash('error', 'Cannot add your comment.');
			  }
		  }
		  if(! \Yii::$app->user->isGuest){
		     if(\common\models\ProductFeedback::find()->where(['id_user' => \Yii::$app->user->identity->username, 'product_id' => $id])->all())
		     {
			    $commentable = false;
		     }
		     else{
			    $commentable = true;
		     }
		  }
		  else{
			 $commentable = false;
		  }
		//comments
		
        return $this->render('view',[
		'model'=> $model,
		'attr' => $attr,
		'feedbacks' => $fdb,
		'pagination' => $pagination,
		'commentable' => $commentable,
		
		]
		);
    }
	
	
    /**
     * @param Category[] $categories
     * @param int $activeId
     * @param int $parent
     * @return array
     */
    private function getMenuItems($categories, $activeId = null, $parent = null)
    {
        $menuItems = [];
        foreach ($categories as $category) {
            if ($category->parent_id === $parent) {
                $menuItems[$category->id] = [
                    'active' => $activeId === $category->id,
                    'label' => $category->title,
                    'url' => ['catalog/list', 'id' => $category->id],
                    'items' => $this->getMenuItems($categories, $activeId, $category->id),
                ];
            }
        }
        return $menuItems;
    }


    /**
     * Returns IDs of category and all its sub-categories
     *
     * @param Category[] $categories all categories
     * @param int $categoryId id of category to start search with
     * @param array $categoryIds
     * @return array $categoryIds
     */
    private function getCategoryIds($categories, $categoryId, &$categoryIds = [])
    {
        foreach ($categories as $category) {
            if ($category->id == $categoryId) {
                $categoryIds[] = $category->id;
            }
            elseif ($category->parent_id == $categoryId){
                $this->getCategoryIds($categories, $category->id, $categoryIds);
            }
        }
        return $categoryIds;
    }
	protected function findModel($id)
	{
	   if(($model=Product::findOne($id))!==null)
	   {
		   return $model;
	   }
	   else
	   {
		   throw new NotFoundHttpException('Not found item');
	   }
	}
}
