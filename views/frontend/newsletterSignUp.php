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

$this->title = 'Winzerhof Mayer-Hörmann | Newsletter-Anmeldung';

$emailMdl = new Email();

$imageMdl = ImageFactory::create('titleImage', 'newsletter');
$image = $imageMdl -> getRandomImage();
if (empty($image)) {
    $imagePath = Url::to('/' . Yii::$app->params[0]['fallbackImagePath']);
} else {
    $imagePath = Url::to('/' . $image[0]['path'] . $image[0]['name']);
}

?>
<div class="container-fluid">
    <div class="row">
        <div class="standardTitleImageContainer" style='background-image: url(<?= $imagePath ?>);'></div>
    </div>
</div>

<div id="containerNewsletter" class="container">
    <div class="row">
        <div class="col-xs-0 col-sm-1 col-md-3"></div>
        <div id="contentNewsletter" class="col-xs-12 col-sm-10 col-md-6">

                <h1> Newsletter Anmeldung </h1>
                <?php
                Pjax::begin();
                if($model->getEmailSaved()) {
                    echo "<p> Ihre E-Mail Adresse wurde zu unserem Newsletter hinzugefügt. Vielen Dank für Ihr Interesse! </p>";
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

                <?= Html::submitButton('Anmelden', ['id' => 'newsletterSubmit', 'class' => 'btn btn-primary']) ?>
                <?php ActiveForm::end() ?>
                <?php Pjax::end(); ?>

            <p> Mit der Registrierung akzeptieren Sie unsere <?= Html::a('Datenschutz- und Nutzungsbedingungen', ['site/impressum']) ?>.
                Selbstverständlich werden Ihre Daten vertraulich behandelt und nicht an Dritte weitergegeben. </p>
        </div>
        <div class="col-xs-0 col-sm-1 col-md-3"></div>
    </div>
</div>