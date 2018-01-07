<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model common\models\OrderItemsAttribute */

$this->title = $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Order Items Details', 'url' => ['//order-item/view','id' => $model->item_id]];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="order-items-attribute-view">

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
            'item_id',
            'attr_title',
            'attr_value',
        ],
    ]) ?>

</div>
