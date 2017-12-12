<?php

/* @var $this yii\web\View */
/* @var $form yii\bootstrap\ActiveForm */
/* @var $model app\models\LoginForm */

use yii\bootstrap\ActiveForm;
use yii\helpers\Html;
use yii\helpers\Url;

$this->title = 'Login';
//$url = Url::to('login/index');
$url = Url::to('/admin');
?>
<div id="backgroundLogin">
    <div class="container">
        <div class="row">
            <div class="col-xs-1 col-sm-3 col-md-3 col-lg-4"> </div>
            <div class="col-xs-10 col-sm-6 col-md-6 col-lg-4">
                <div id="loginContainer">
                    <h1><?= Html::encode($this->title) ?></h1>
                    <p><?= Html::encode($model->getMessage()) ?></p>
                    <?php $form = ActiveForm::begin([
                        'action' => $url,
                        'options' => ['method' => 'post'],
                        'id' => 'login-form',
                        'layout' => 'default',
                    ]); ?>

                    <?= $form->field($model, 'username')->textInput(['autofocus' => true])->label('Username') ?>

                    <?= $form->field($model, 'password')->passwordInput()->label('Passwort') ?>
                    <div class="form-group">
                        <?= Html::submitButton('Anmelden', ['class' => 'btn btn-primary', 'name' => 'login-button', 'id' => 'loginButton']) ?>
                    </div>


                    <?php ActiveForm::end(); ?>
                </div>
            </div>
            <div class="col-xs-1 col-sm-3 col-md-3 col-lg-4"> </div>
        </div>
    </div>
</div>

