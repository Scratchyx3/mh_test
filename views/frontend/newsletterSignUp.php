<?php
/**
 * Created by PhpStorm.
 * User: Christoph Rohrmoser
 * Date: 27.06.2017
 * Time: 11:25
 */

use app\models\Email;
use app\models\Image\ImageFactory;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\widgets\ActiveForm;
use yii\widgets\Pjax;


$emailMdl = new Email();

$imageMdl = ImageFactory::create('titleImage', 'newsletter');
$image = $imageMdl -> getRandomImage();
$imagePath = Url::to('/' . $image[0]['path'] . $image[0]['name']);

?>
<div class="container-fluid">
    <div class="row">
        <div class="standardTitleImageContainer" style='background-image: url(<?= $imagePath ?>);'></div>
    </div>
</div>

<div class="container">
    <div class="row">
        <div class="col-xs-12">
        <?php
        Pjax::begin();
        if($model->getEmailSaved()) {
            echo "<h1> Ihre E-Mail Adresse wurde zu unserem Newsletter hinzugefügt. Vielen Dank für Ihr Interesse! </h1>";
        }
        ?>
        <?php
        $form = ActiveForm::begin([
            'id' => 'card',
            'action' => ['frontend/add-email'],
            'options' => ['method' => 'post', 'class' => 'form-horizontal'],
        ]) ?>

        <?= $form->field($emailMdl, 'email')->label('Email Adresse')->input('email') ?>

        <?= $form->field($emailMdl, 'antiSpam')->textInput(['id' => 'antiSpamField'])->label(false) ?>

        <?= Html::submitButton('Bestätigen', ['class' => 'btn btn-primary']) ?>
        <?php ActiveForm::end() ?>
        <?php Pjax::end(); ?>
        </div>
    </div>
</div>