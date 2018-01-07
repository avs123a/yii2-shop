<?php
use yii\helpers\Html;
use yii\helpers\MarkDown;
//use yii\widgets\ActiveForm;
?>
<h2>Product information <i class="fa fa-info-circle" id="itemhelp" aria-hidden="true"></i></h2>
<div class="row">
   <div class="col-md-6">
   <?php
        $images = $model->images;
        if (isset($images[0])) {
            echo Html::img($images[0]->getUrl(), ['width' => '100%','height'=>'400px']);
        }
    ?>
   </div>
   <div class="col-md-6">
        <h4><?= Html::encode($model->title) ?></h4>
    </div>
   <div class="col-xs-6">
         <?= Html::beginForm(['catalog/view','id' => $model->id],'get'); ?>
		     
		    <?= Html::endForm(); ?>
         $<?= Html::encode($model->price) ?><br>
			 <?= Html::beginForm(['cart/add', 'id' => $model->id], 'post') ?>
			     <?php foreach($attr as $atrib): ?>
			     <label size="20"><?= $atrib->attr_title ?></label>
			     <?php $attr_value=\common\models\ProductAttributeValue::find()->where(['attr_id' =>$atrib['id']])->indexBy('id')->asArray()->all();?>
			          <select name="<?=$atrib->attr_title ?>"">
			          <option disabled selected>Choose</option>
			          <?php foreach($attr_value as $atr_val): ?>
			          <option value="<?=$atr_val['value']?>"><?=$atr_val['value']?></option>
			          <?php endforeach; ?>
			          </select><br>
			          <?php endforeach; ?>
                      <label>Quantity</label><input type="number" name="quant" autocomplete="1" min="1" max="<?= Html::encode($model->instore) ?>"><label>(<?= Html::encode($model->instore) ?> available)</label><br>
					  <button type="submit" name="cartadd" class="btn btn-success" style="background-color:#0033ff"><i class="fa fa-shopping-cart" aria-hidden="true"></i> Add To Cart</button>
                
			<?= Html::endForm() ?>
	</div> 
   <div class="row">
	<div class="col-md-12"><?= Html::encode($model->description) ?></div>
   </div>
   <hr>
   <button type="button" id="feedbackshow">Feedbacks<i class="fa fa-level-down" aria-hidden="true"></i></button>
   <button type="button" id="feedbackhide" hidden="hidden">Feedbacks<i class="fa fa-level-up" aria-hidden="true"></i></button>
   <div id="feedback1" hidden="hidden">
		<?php if($feedbacks==null):
			echo "This product have not feedbacks";
			else: 
		?>
		<h4>Product feedback</h4>
		<table class="col-xs-9" style="text-align:center;border:1px solid black" id="comments1" >
		 <tr>
		   <th class="col-xs-1" style="border:1px solid black;text-align:center;background-color:#0099cc">Username</th>
		   <th style="border:1px solid black;text-align:center;background-color:#33ccff">Comment</th>
		 </tr>
         <?php foreach($feedbacks as $feedback):?>
         <tr>
           <td style="background-color:#ccffff;border:1px solid black" class="col-xs-1"><?= Html::encode($feedback['id_user'])?></td>
	       <td style="background-color:#ffffff;border:1px solid black" ><?= $feedback['comment'] ?></td>
         </tr>
         <?php endforeach; ?>
        </table>
        <?= \yii\widgets\LinkPager::widget(['pagination' => $pagination])?>
		<?php endif?>
   </div>
   <?php if (!Yii::$app->user->isGuest): ?>
    <div class="col-xs-12" id="new_comment1" hidden="hidden">
	<?php if($commentable==false){
			echo "<h4>You may add only 1 comment about 1 product</h4>";
		}
		else{ ?>
		<?= Html::beginForm(['catalog/view', 'id' => $model->id], 'get') ?>
		        <div class="row">
				    <br><br>
                    <label>Your Comment</label>
				</div>
				<div class="row">
		            <textarea name="newcomment" class="col-xs-9" rows="5"></textarea>
				</div>
				<div class="row">
                    <input type="submit" name="add_comment" class="btn btn-success" style="background-color:#0033ff" value="Add Your Comment">
				</div>
	    <?= Html::endForm() ?>
		<?php } ?>
    </div>
     <?php else: ?>
     <h4>Adding comment available only for registered users</h4>
	<?php endif ?>
	
</div>

<div class="modal fade" id="item_info">
   <div class="modal-dialog">
       <div class="modal-content">
	      <div class="modal-header" style="background-color:#0033ff;color:#ffffff">
		    Helpful Information
		  </div>
		  <div class="modal-body">
		    <p>
			   This is item view page.
			   On this page you may view product,select properties and quantity,add to cart product with choosen properties and quantity.
		       Besides ,you may view comments about this product or add your comment
			</p>
		  </div>
		  <div class="modal-footer" style="background-color:#cccccc">
		     <button type="button" class="btn btn-danger" id="itemhelpclose"><i class="fa fa-times" aria-hidden="true"></i></button>
		  </div>
       </div>
   </div>
</div>

<script>
  $(document).ready(function(){
	  $("#itemhelp").click(function(){
		  $("#item_info").modal('show');
	  });
	  $("#itemhelpclose").click(function(){
		  $("#item_info").modal('hide');
	  });
	  $("#feedbackshow").click(function(){
		  $("#feedbackhide").show();
		  $("#feedback1").show();
		  $("#new_comment1").show();
		  $("#feedbackshow").hide();
	  });
	  $("#feedbackhide").click(function(){
		  $("#feedbackshow").show();
		  $("#feedback1").hide();
		  $("#new_comment1").hide();
		  $("#feedbackhide").hide();
	  });
  });
</script>