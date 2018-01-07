<?php
use yii\helpers\Html;
use yii\widgets\ListView;
//use yii\widgets\ActiveForm;
use yii\widgets\Menu;

/* @var $this yii\web\View */
$title = $category === null ? 'Shopping' : $category->title;
$this->title = Html::encode($title);
?>

<h1><?= Html::encode($title) ?> <i class="fa fa-info-circle" id="cataloghelp" aria-hidden="true"></i></h1>
<div>
 <?php  //echo $this->render('_search','model'=>$model); ?>
 <div class="search_box">
  <form name="search" method="get" action="<?= \yii\helpers\Url::to(['catalog/list']) ?>">
     <input type="text" style="height:35px" class="col-xs-6" placeholder="Search products" name="gsearch">
	 <button type="submit" style="background-color:#0033ff;color:#ffffff;height:35px" name="searchbutton" value="Search"><i class="fa fa-search" aria-hidden="true"> </i></button>
  </form>
  </div>
</div>
<br>
<div class="container-fluid">
  <div class="row">
      <div class="col-md-2" style="background-color:#ccffff">
          <?= Menu::widget([
              'items' => $menuItems,
              'options' => [
                  'class' => 'menu',
              ],
          ]) ?>
      </div>
	  <button type="button" id="fshow1" hidden="hidden">filters <i class="fa fa-level-down" aria-hidden="true"></i></button>
	  <button type="button" id="fhide1" >filters <i class="fa fa-level-up" aria-hidden="true"></i></button>
	  <div class="col-xs-10" style="background-color:#33ccff">
         <form name="filters" id="filters1" method="get" action="<?= \yii\helpers\Url::to(['catalog/list']) ?>">
		    <label>Price Min:</label><input type="text" size="4" name="minprice">
			<label>Max</label><input type="text" size="4" name="maxprice">
			<label>   Sort by</label>
			<select name="sort">
			  <option value="default">Default</option>
			  <!-- <option value="popularity">Popularity</option> -->
			  <option value="price_high">Price - high to low</option>
			  <option value="price_low">Price - low to high</option>
			</select>
			<input type="submit" name="addfilters" style="background-color:#0033ff;color:#ffffff" value="Use Filters">
			<input type="submit" name="resetfilters" style="background-color:#ff0000;color:#ffffff" value="Reset ALL">
		 </form>
      </div>
      <div class="col-xs-10">
          <?= ListView::widget([
              'dataProvider' => $productsDataProvider,
              'itemView' => '_product',
          ]) ?>
      </div>
  </div>
</div>


<div class="modal fade" id="catalog_info">
   <div class="modal-dialog">
       <div class="modal-content">
	      <div class="modal-header" style="background-color:#0033ff;color:#ffffff">
		    Helpful Information
		  </div>
		  <div class="modal-body">
		    <p>
			   This is catalog.
			   On this page you may search,view products by categories in left menu,search service,filters   and view details of choosen product.
			   You may hide filters if they are not needed.
			</p>
		  </div>
		  <div class="modal-footer" style="background-color:#cccccc">
		     <button type="button" class="btn btn-danger" id="cataloghelpclose"><i class="fa fa-times" aria-hidden="true"></i></button>
		  </div>
       </div>
   </div>
</div>

<script>
  $(document).ready(function(){
	  $("#cataloghelp").click(function(){
		  $("#catalog_info").modal('show');
	  });
	  $("#cataloghelpclose").click(function(){
		  $("#catalog_info").modal('hide');
	  });
	  $("#fshow1").click(function(){
		  $("#filters1").show();
		  $("#fhide1").show();
		  $("#fshow1").hide();
	  });
	  $("#fhide1").click(function(){
		  $("#filters1").hide();
		  $("#fshow1").show();
		  $("#fhide1").hide();
	  });
	  
  });
</script>