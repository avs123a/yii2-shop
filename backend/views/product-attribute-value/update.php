<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model common\models\ProductAttributeValue */

$this->title = 'Update Product Attribute Value: ' . $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Product Attribute Details', 'url' => ['//product-attributes/view','id' => $model->attr_id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="product-attribute-value-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
