<?php
use yii\helpers\Html;

/* @var $this yii\web\View */
$this->title = 'About';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="site-about">
    <h1><?= Html::encode($this->title) ?></h1>

    <p>This is demonstration online market(from my portfolio)</p>
	
	<p>This market show functional of online market and you may try to use this online market and control this site as administrator with full rights.
	Logins and passwords of same accounts(including admin) you may see below(in this resource you <strong>may not change login and passwords</strong></p>
	
	<div class="row" style="background-color:red">
	  <h1>WARNING!!!</h1>
	  <h2>Payments in this site is NOT REAL! They are in test mode(wallets for testing).So you must not pay completely.</h2>
    </div>
	<p>Script of this site allow change payment settings of site, BUT in this site I NOT ALLOW TO DO IT(If you will order creating of similar site or buy this script ,you may change payment settings in YOUR SITE.</p>
	<div class="row" style="background-color:#ffffff">
	  <h3>Accounts for demonstration:</h3>
	  <table class="col-xs-9">
	    <tr>
		  <th>Login</th>
		  <th>Password</th>
		  <th>ROLE</th>
		</tr>
		<tr>
		  <td>admin</td>
		  <td>avs03021998</td>
		  <td>ADMINISTRATOR</td>
		</tr>
	  </table>
	  <br>
	  <p>You also may register as user in this site.</p>
	  <div class="row">
	    <h4>If you have any question or wishes,if you want to buy script or get similar site - please, write message on email :<strong>an128z56@gmail.com</strong>.Please,write the next subject in your message:<strong>Creating site,Update site,Buy script</strong>.(It is required.If You will not write a subject of email,your letter will be view as SPAM)</h4>
	  </div>
	</div>
    <code><?= __FILE__ ?></code>
</div>
