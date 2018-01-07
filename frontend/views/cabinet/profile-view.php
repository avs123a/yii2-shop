<?php
use yii\helpers\Html;

$this->title = 'My Profile';
?>
<style>
  ul{
	  list-style:none;
  }
</style>
<div class="container">
<div class="row">
 <nav class="navbar-default" >
  <ul class="nav navbar-nav" style="background-color:#ccffff">
    <li><?= Html::a('Cabinet info',['cabinet/index']) ?></li>
	<li><?= Html::a('My Profile',['cabinet/profile-view']) ?></li>
	<li><?= Html::a('My Orders',['cabinet/archive']) ?></li>
  </ul>
 </nav>
</div>
<h2> Your Profile </h2>
<div class="row">
<div class="col-xs-8">
   <hr>
   <?php if($model->surname == null): ?>
    <div class="row">
	 <h2>Your profile is not completed</h2>
	 <h3>Please,fill profile</h3>
	 <div class="col-xs-3"><?= Html::a('Fill Profile',['cabinet/profile'],['class' => 'btn btn-success', 'style' => 'background-color:#0033ff']) ?></div>
    </div>
	<?php else: ?>
	<h3>Personal data</h3>
	<div class="row">
      <div class="col-xs-6">
	    <ul>
            <li>Surname:</li>
            <li>Name:</li>
		</ul>
	  </div>
	  <div class="col-xs-6">
	    <ul>
            <li><?=$model->surname ?></li>
            <li><?=$model->name ?></li>
		</ul>
	  </div>
	</div>
	<hr>
	<h3>Your ddress</h3>
	<div class="row">
	  <div class="col-xs-6">
		<ul>
            <li>Country:</li>
            <li>Region/State/Province:</li>
            <li>City:</li>
            <li>Address:</li>
            <li>Zip (postal) Code:</li>
		</ul>
	  </div>
	  <div class="col-xs-6">
	    <ul>
            <li><?=$model->country ?></li>
            <li><?=$model->region ?></li>
            <li><?=$model->city ?></li>
            <li><?=$model->address ?></li>
            <li><?=$model->zip_code ?></li>
		</ul>
	  </div>
	</div>
	<hr>
	<h3>Contact information</h3>
	<div class="row">
	  <div class="col-xs-6">
		<ul>
            <li>Phone:</li>
            <li>Email:</li>
        </ul>
	  </div>
	  <div class="col-xs-6">
	    <ul>
            <li><?=$model->phone ?></li>
            <li><?=$model->email ?></li>
        </ul>
	  </div>
	</div>
	<?php endif; ?>
  </div>
</div>
</div>
<?php if($model->surname != null): ?>
<div class="form-group">
   <?= Html::a('Update Profile',['cabinet/profile'],['class' => 'btn btn-success', 'style' => 'background-color:#0033ff']) ?>
   <button class="btn btn-primary" id="mailbtn">Change Email</button>
</div>
<?php endif; ?>
<div class="col-xs-6" id="new_mail" hidden="hidden">
<?= Html::beginForm(['cabinet/profile-view'],'post') ?>
  <label>New email address:</label>
  <input type="text" name="email_new">
  <?= Html::SubmitButton('Save',['style'=>'background-color:#0033ff','class' =>'btn btn-success']) ?>
  <button type="button" id="mail_cancel" class="btn btn-danger">Cancel</button>
<?= Html::endForm(); ?>
</div>
<script>
  $(document).ready(function(){
	  alert("This page show your profile");
	  $("#mailbtn").click(function(){
		  $("#new_mail").show();
	  });
	  $("#mail_cancel").click(function(){
		  $("#new_mail").hide();
	  });
  });
</script>