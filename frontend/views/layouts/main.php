<?php
use yii\helpers\Html;
use yii\bootstrap\Nav;
use yii\bootstrap\NavBar;
use yii\widgets\Breadcrumbs;
use yii\widgets\ActiveForm;
use frontend\assets\AppAsset;
use frontend\widgets\Alert;

/* @var $this \yii\web\View */
/* @var $content string */

AppAsset::register($this);
?>
<?php $this->beginPage() ?>
<!DOCTYPE html>
<html lang="<?= Yii::$app->language ?>">
<head>
    <meta charset="<?= Yii::$app->charset ?>"/>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <?= Html::csrfMetaTags() ?>
    <title><?= Html::encode($this->title) ?></title>
    <?php $this->head() ?>
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
	 <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script> 
</head>
<body style="background-color:#00ffff">
    <?php $this->beginBody() ?>
    <div class="wrap">
        <?php
            NavBar::begin([
                'brandLabel' => 'Demo Shop',
                'brandUrl' => Yii::$app->homeUrl,
                'options' => [
                    'class' => 'navbar-inverse navbar-fixed-top',
					'style'=>'background-color:#0033ff',
                ],
            ]);
            $itemsInCart = Yii::$app->cart->getCount();
            $menuItems = [
                ['label' => 'About', 'url' => ['/site/about']],
				['label' => 'News', 'url' => ['/new/index']],
                ['label' => 'Contact', 'url' => ['/site/contact']],
                ['label' => 'My cart' . ($itemsInCart ? " ($itemsInCart)" : ''), 'url' => ['/cart/list']],
            ];
            if (Yii::$app->user->isGuest) {
                $menuItems[] = ['label' => 'Signup', 'url' => ['/site/signup']];
                $menuItems[] = ['label' => 'Login', 'url' => ['/site/login']];
            } else {
				$menuItems[] = ['label' => 'My Cabinet', 'url' => ['/cabinet/index']];
                $menuItems[] = [
                    'label' => 'Logout (' . Yii::$app->user->identity->username . ')',
                    'url' => ['/site/logout'],
                    'linkOptions' => ['data-method' => 'post']
                ];
            }
            echo Nav::widget([
                'options' => ['class' => 'navbar-nav navbar-right'],
                'items' => $menuItems,
            ]);
            NavBar::end();
        ?>

        <div class="container">
        <?= Breadcrumbs::widget([
            'links' => isset($this->params['breadcrumbs']) ? $this->params['breadcrumbs'] : [],
        ]) ?>
        <?= Alert::widget() ?>
        <?= $content ?>
        </div>
    </div>

    <footer class="footer" style="background-color:#000000;color:#ffffff">
        <div class="container">
        <p class="pull-left">&copy; Created by A.Sanzharovskyi <?= date('Y') ?></p>
		<p class="pull-center">&nbsp;
		   <img src="http://plati.ru/img/we_accept_wm_en-US.png" style="width: 88px; height: 31px;" alt="Webmoney">&nbsp;
		   <img src="https://www.newenergyco-op.co.uk/user/paypal.jpg" style="width: 88px; height: 31px;" alt="PayPal">&nbsp;
		   <img src="https://payeer.com/bitrix/templates/difiz/img/quote-logo.png" style="width: 88px; height: 31px;" alt="Payeer">&nbsp;
		   <img src="https://hostnesta.com/images/perfectmoney-accepted.png" style="width: 88px; height: 31px;" alt="Perfect Money">&nbsp;
		   <img src="https://www.iphones.ru/wp-content/uploads/2014/06/logo.jpg" style="width: 88px; height: 31px;" alt="Qiwi">&nbsp;
		   <img src="http://www.konstantinkanin.com/en/wp-content/uploads/2016/08/yandexmoney-logo-1024x272.jpg" style="width: 88px; height: 31px;" alt="Yandex Money">&nbsp;
		   <img src="https://raw.githubusercontent.com/hiqdev/payment-icons/master/src/assets/png/lg/interkassa.png" style="width: 88px; height: 31px;" alt="Interkassa">&nbsp;
		   <img src="https://worldcore.eu/blog/wp-content/uploads/2016/07/advcash-2.png" style="width: 88px; height: 31px;" alt="AdvCash">&nbsp;
		   <img src="http://www.a1dedicatedservers.com/images/okpay.png" style="width: 88px; height: 31px;" alt="OKPay">&nbsp;
		</p>
        <p class="pull-right"><?= Yii::powered() ?></p>
        </div>
    </footer>

    <?php $this->endBody() ?>
</body>
</html>
<?php $this->endPage() ?>
