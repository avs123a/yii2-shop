<?php
use \yii\helpers\Html;
use \yii\bootstrap\ActiveForm;

/* @var $this yii\web\View */
/* @var $products common\models\Product[] */
?>
<h1>Your order</h1>

<div class="container-fluid">
    <h3>Products information</h3>
    <div class="row">
        <div class="col-xs-4">

        </div>
        <div class="col-xs-2">
            Price
        </div>
        <div class="col-xs-2">
            Quantity
        </div>
        <div class="col-xs-2">
            Cost
        </div>
    </div>
    <?php foreach ($products as $product):?>
    <div class="row">
        <div class="col-xs-4">
            <?= Html::encode($product->title) ?>
        </div>
        <div class="col-xs-2">
            $<?= $product->price ?>
        </div>
        <div class="col-xs-2">
            <?= $quantity = $product->getQuantity()?>
        </div>
        <div class="col-xs-2">
            $<?= $product->price*$product->getQuantity() ?>
        </div>
    </div>
    <?php endforeach ?>
    <div class="row">
        <div class="col-xs-8">

        </div>
        <div class="col-xs-2">
            Total: $<?= $total ?>
        </div>
    </div>
    <hr>
    <div class="row">
        <div class="col-xs-12">
            <?php
            /* @var $form ActiveForm */
            $form = ActiveForm::begin([
                'id' => 'order-form',
				//'action' => \yii\helpers\Url::to(
            ]) ?>
			<?php if(\Yii::$app->user->isGuest):?>
			<?= $form->field($order, 'customer_type')->hiddenInput(['value' => 'guest'])->label(false) ?>
            <div class="row">
			 <h3>&nbsp;&nbsp;Personal information</h3>
			  <div class="col-md-5"><?= $form->field($order, 'surname') ?></div>
              <div class="col-md-5"><?= $form->field($order, 'name') ?></div>
			</div><hr>
			<div class="row">
			 <h3>&nbsp;&nbsp; Address for shipping</h3>
			 <div class="col-md-5">
			  <?= $form->field($order, 'country') ?>
              <?= $form->field($order, 'region') ?>
			 </div>
			 <div class="col-md-5">
			  <?= $form->field($order, 'city') ?>
              <?= $form->field($order, 'address') ?>
			  <?= $form->field($order, 'zip_code') ?>
			 </div>
			</div>
			<hr>
			<?php else: 
			$user = \common\models\User::findOne(['username' => \Yii::$app->user->identity->username]);
			if($user->surname!=null):
			?>
			  <?= $form->field($order, 'customer_type')->hiddenInput(['value' => 'user'])->label(false) ?>
			  <?= $form->field($order, 'surname')->hiddenInput(['value' => $user->surname])->label(false) ?>
			  <?= $form->field($order, 'name')->hiddenInput(['value' => $user->name])->label(false) ?>
			  <?= $form->field($order, 'country')->hiddenInput(['value' => $user->country])->label(false) ?>
              <?= $form->field($order, 'region')->hiddenInput(['value' => $user->region])->label(false) ?>
			  <?= $form->field($order, 'city')->hiddenInput(['value' => $user->city])->label(false) ?>
              <?= $form->field($order, 'address')->hiddenInput(['value' => $user->address])->label(false) ?>
			  <?= $form->field($order, 'zip_code')->hiddenInput(['value' => $user->zip_code])->label(false) ?>
			  <?= $form->field($order, 'phone')->hiddenInput(['value' => $user->phone])->label(false) ?>
			  <?= $form->field($order, 'email')->hiddenInput(['value' => $user->email])->label(false) ?>
			<?php else: 
			   \Yii::$app->session->addFlash('error','Fill your profile for creating orders fast and using other advantages of having account!!!');
			   echo $this->redirect(['//cabinet/profile']);
			endif; ?>
	        <?php endif; ?>
			<div class="row">
			<?php if(\Yii::$app->user->isGuest): ?>
			 <div class="col-md-5">
			 <h3>Contact information</h3>
			  <?= $form->field($order, 'phone') ?>
              <?= $form->field($order, 'email') ?>
			 </div>
			<?php endif; ?>
			 <div class="col-md-5">
			 <h3>Payment information</h3>
			  <?= $form->field($order, 'paysystem')->dropDownList($items=array('Pay to courier'=>'Pay to courier','Pay in office'=>'Pay in office','Webmoney'=>'Webmoney','Payeer'=>'Payeer','AdvCash'=>'AdvCash','Blockchain'=>'Blockchain','PayPal'=>'PayPal','WalletOne'=>'WalletOne','Perfect Money'=>'Perfect Money','Interkassa'=>'Interkassa','Yandex money'=>'Yandex money','Qiwi'=>'Qiwi','OKpay'=>'OKpay','btc-e'=>'btc-e'),['prompt'=>'Select payment method']); ?>
              <?= $form->field($order, 'wallet') ?>
			 </div>
			</div>
            <hr>
            <div class="form-group row">
                <div class="col-xs-10">
				   <?= $form->field($order, 'notes')->textarea() ?>
                    <?= Html::submitButton('Order', ['class' => 'btn btn-primary']) ?>
                </div>
            </div>

            <?php ActiveForm::end() ?>
        </div>
    </div>
</div>