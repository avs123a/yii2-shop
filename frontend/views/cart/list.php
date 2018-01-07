<?php
use \yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $products common\models\Product[] */
?>
<h1>Your cart <i class="fa fa-info-circle" id="carthelp" aria-hidden="true"></i></h1>

<div class="container-fluid" style="background-color:#ffffff">
    <div class="row">
        <div class="col-xs-2">

        </div>
		<div class="col-xs-2">
           Selected attributes
        </div>
        <div class="col-xs-2" >
            &nbsp;&nbsp;&nbsp;Price(with attributes)
        </div>
		<div class="col-xs-1">

        </div>
        <div class="col-xs-2" style="text-align:center">
            Quantity
        </div>
        <div class="col-xs-2" style="text-align:center">
            Cost
        </div>
        
		<div class="col-xs-1">

        </div>
    </div>
    <?php foreach ($products as $product):?>
	<?php
	   $nquantity = $product->instore;
	?>
    <div class="row">
        <div class="col-xs-1">
            <?= Html::encode($product->title) ?>
        </div>
		<div class="col-xs-1">

        </div>
		<div class="col-xs-2">
		   <?php $atrib=\common\models\ProductAttributes::find()->where(['product_id' => $product->getId()])->all(); ?>
		   <?php foreach($atrib as $atr):  $atrid=$atr->id?>
		    <div class="row">
		     <p><?=$atr->attr_title ?>:&nbsp;
			 <?php  
			     $q_p = \Yii::$app->session->get("Q_$atrid")/100;
				 $nquantity*=$q_p;
                 echo \Yii::$app->session->get("A_$atrid");		 
			 ?></p>
			 
			</div>
		   <?php endforeach ?>
        </div>
        <div class="col-xs-2">
            <p size="5">$<?= $product->price; ?></p>
        </div>
		<div class="col-xs-1">
        
        </div>
        <div class="col-xs-2" style="text-align:center">
            <div class="row"><strong><?= $quantity = $product->getQuantity()?></strong>   /  (<?= intval($nquantity) ?> available)</div>

            <?= Html::a('-', ['cart/update', 'id' => $product->getId(), 'quantity' => $quantity - 1], ['class' => 'btn btn-danger', 'disabled' => ($quantity - 1) < 1, 'style'=>'background-color:#ff0000'])?>
            <?= Html::a('+', ['cart/update', 'id' => $product->getId(), 'quantity' => $quantity + 1], ['class' => 'btn btn-success','disabled' => ($quantity+1)>$nquantity,'style'=>'background-color:#0033ff'])?>
			<?php
			  if($quantity>$nquantity) \Yii::$app->session->addFlash('error','Sorry,this quantity is not available in store.Please,choose other quantity');
			?>
        </div>
        <div class="col-xs-2" style="text-align:center">
            $<?= $product->price*$product->getQuantity() ?>
        </div>
		
        <div class="col-xs-1">
            <?= Html::a('×', ['cart/remove', 'id' => $product->getId()], ['class' => 'btn btn-danger'])?>
        </div>
    </div>
	<hr>
    <?php endforeach ?>
    <div class="row">
        <div class="col-xs-9">

        </div>
        <div class="col-xs-2"  style="text-align:center">
            Total: $<?= $total ?>
        </div>

        <div class="col-xs-1">
           <?=Html::a('Order',['cart/order'],['class' => 'btn btn-success','style' => 'background-color:#0033ff']) ?>
        </div>
    </div>
</div>

<div class="modal fade" id="cart_info">
   <div class="modal-dialog">
       <div class="modal-content">
	      <div class="modal-header" style="background-color:#0033ff;color:#ffffff">
		    Helpful Information
		  </div>
		  <div class="modal-body">
		    <p>
			   This is your cart.
			   On this page you may view products,change quantity and make orders.
			   You make one order with some products.
			   Registered users have next preference : they may pay later(if guest not pay ,his order is not valid).
			</p>
		  </div>
		  <div class="modal-footer" style="background-color:#cccccc">
		     <button type="button" class="btn btn-danger" id="carthelpclose"><i class="fa fa-times" aria-hidden="true"></i></button>
		  </div>
       </div>
   </div>
</div>

<script>
  $(document).ready(function(){
	  $("#carthelp").click(function(){
		  $("#cart_info").modal('show');
	  });
	  $("#carthelpclose").click(function(){
		  $("#cart_info").modal('hide');
	  });
  });
</script>
