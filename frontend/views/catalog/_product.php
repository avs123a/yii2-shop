<?php
use yii\helpers\Html;
use yii\helpers\Markdown;
?>
<?php /** @var $model \common\models\Product */ ?>
<div class="col-md-4 well">
   <div class="row">
    <div class="col-xs-12">
        <?php
        $images = $model->images;
        if (isset($images[0])) {
            echo Html::img($images[0]->getUrl(), ['width' => '100%','height'=>'250px']);
        }
        ?>
    </div>
   </div>
   <div class="row">
    <div class="col-xs-12">
        <h4><?= Html::encode($model->title) ?></h4>
    </div>
   </div>
        <div class="row">
            <div class="col-xs-6">$<?= $model->price ?></div>
            <div class="col-xs-6"><a href="<?= \yii\helpers\Url::to(['catalog/view','id' => $model->id]) ?>"><div class="btn btn-success" style="background-color:#0033ff"><i class="fa fa-eye" aria-hidden="true"></i></div></a></div>
        </div>
</div>