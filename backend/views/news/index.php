<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel backend\models\NewsSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'News';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="news-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Create News', ['create'], ['class' => 'btn btn-success','style'=>'background-color:#0033ff']) ?>
    </p>
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            'newsID',
            'news_title',
            'news_text',
            ['class' => 'yii\grid\CheckboxColumn',],
            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
</div>
<script>
  $(document).ready(function(){
	  alert('This is NEWS page.In this page you can view,create,update or delete news of site');
  });
</script>
