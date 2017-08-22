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
<div class="container">
    <div class="row">
        <div id="loginContainer">
            <h1><?= Html::encode($this->title) ?></h1>
            <p><?= Html::encode($model->getMessage()) ?></p>
            <?php $form = ActiveForm::begin([
                'action' => $url,
                'options' => ['method' => 'post'],
                'id' => 'login-form',
                'layout' => 'horizontal',
                'fieldConfig' => [
                    'template' => "{label}\n<div class=\"col-lg-3\">{input}</div>\n<div class=\"col-lg-8\">{error}</div>",
                    'labelOptions' => ['class' => 'col-lg-1 control-label'],
                ],
            ]); ?>

            <?= $form->field($model, 'username')->textInput(['autofocus' => true])->label('Username') ?>

            <?= $form->field($model, 'password')->passwordInput()->label('Passwort') ?>
            <div class="form-group">
                <div class="col-lg-offset-1 col-lg-11">
                    <?= Html::submitButton('Login', ['class' => 'btn btn-primary', 'name' => 'login-button']) ?>
                </div>
            </div>


            <?php ActiveForm::end(); ?>
    </div>

