<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model backend\models\Method */

$this->title = 'Create Method';
$this->params['breadcrumbs'][] = ['label' => 'Methods', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="method-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
