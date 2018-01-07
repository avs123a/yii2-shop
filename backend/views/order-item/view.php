<?php

use yii\helpers\Html;
use yii\widgets\DetailView;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $model common\models\OrderItem */

$this->title = $model->title;
$this->params['breadcrumbs'][] = ['label' => 'Order Details', 'url' => ['//order/view','id' => $model->order_id]];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="order-item-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Update', ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Delete', ['delete', 'id' => $model->id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => 'Are you sure you want to delete this item?',
                'method' => 'post',
            ],
        ]) ?>
    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'id',
            'order_id',
            'title',
            'price',
            'product_id',
            'quantity',
        ],
    ]) ?>

</div>
<hr>
<h3>Choosed attributes to this item</h3>
<?= GridView::widget([
        'dataProvider' => $dataProviderOrderItemAttr,
        'filterModel' => $searchModelOrderItemAttr,
        'columns' => [

            'id',
            'attr_title',
            'attr_value',

            [
			 'class' => 'yii\grid\ActionColumn',
			 'template' => '{update},{delete}',
			 'controller' => 'order-items-attribute',
			],
        ],
    ]); ?>
