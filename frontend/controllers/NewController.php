<?php

namespace frontend\controllers;

use backend\models\News;
use yii\data\Pagination;

class NewController extends \yii\web\Controller
{
    public function actionIndex()
    {
    $query=News::find()->asArray();
    $pagination=new Pagination(['defaultPageSize'=>10,'totalCount'=>$query->count(),]);
	$news=$query->orderBy('newsID','desc')->offset($pagination->offset)->limit($pagination->limit)->all();
    return $this->render('index',['news'=>$news,'pagination'=>$pagination,]);
    }
}
