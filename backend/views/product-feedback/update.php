<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model common\models\ProductFeedback */

$this->title = 'Update Product Feedback: ' . $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Product Details', 'url' => ['//product/view','id' => $model->product_id]];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="product-feedback-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
