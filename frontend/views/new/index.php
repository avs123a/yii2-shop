<?php
use yii\helpers\Html;
use yii\widgets\LinkPager;
?>
<ul>
 <?php foreach($news as $n1): ?>
  <li>
    <h4><?= Html::encode("{$n1['news_title']}") ?>:</h4>
	<?= $n1['news_text'] ?>
  </li>
 <?php endforeach; ?>
</ul>
<?= LinkPager::widget(['pagination'=>$pagination]) ?>