<?php

use app\models\Image;
use yii\helpers\Html;
use yii\helpers\Url;

$session = Yii::$app->session;
if (!$session->isActive) {
    $session->open();
}
// check if there is already a title image saved in session
if ($session->has('startseiteTitleImage') && file_exists($session->get('startseiteTitleImage'))) {
    $imagePath = $session->get('startseiteTitleImage');
// get path to random title image
} else {
    $imageMdl = new Image();
    $imageMdl -> type = 'startseite';
    $imageMdl -> setPath();
    $imagePath = $imageMdl -> getRndImagePath();
    $session->set('startseiteTitleImage', $imagePath);
}
$url = Url::to('/' . $imagePath);
$this->title = 'Mayer Hörmann';
?>
<div id="iconDownContainer">
    <a href="#headlineAktuelles">
        <div class="iconDown">

        </div>
    </a>
</div>

<div class="container-fluid">
    <div class="row">
        <div class="indexTitleImageContainer" style='background-image: url(<?= $url ?>);'></div>
    </div>
    <div id="row">
        <div id="headlineAktuelles" class="row headline">
            <h1> Aktuelles </h1>
        </div>
    </div>


    <div id="row">
        <div class="col-xs-12 col-sm-12 col-md-6 col-lg-4">
            <div class="card">
                <div class="cardImageContainer">
                    <?php echo Html::img('@web/' . $imagePath, ['alt'=>'weingarten', 'class'=>'cardImage']); ?>
                </div>
                <div class="cardHeadline">
                    <h1> Meine Aktuelles Ding und noch mehr Text</h1>
                </div>
                <div class="cardText">
                    <p>Lorem ipsum dolor sit amet, consetetur sadipscing elitr, sed diam nonumy eirmod tempor invidunt
                        ut labore et dolore magna aliquyam erat, sed diam voluptua. At vero eos et accusam et justo duo
                        dolores et ea rebum. Stet clita kasd gubergren, no sea takimata sanctus est Lorem ipsum dolor sit amet.
                        Lorem ipsum dolor sit amet, consetetur sadipscing elitr, sed diam nonumy eirmod tempor invidunt ut
                        labore et dolore magna aliquyam erat, sed diam voluptua.</p>
                </div>
            </div>
        </div>
        <div class="col-xs-12 col-sm-12 col-md-6 col-lg-4">
            <div class="card">
                <div class="cardImageContainer">
                    <?php echo Html::img('@web/' . $imagePath, ['alt'=>'weingarten', 'class'=>'cardImage']); ?>
                </div>

                <div class="cardHeadline">
                    <h1> Meine Aktuelles Ding</h1>
                </div>
                <div class="cardText">
                    <p>Lorem ipsum dolor sit amet, consetetur sadipscing elitr, sed diam nonumy eirmod tempor invidunt
                        ut labore et dolore magna aliquyam erat, sed diam voluptua. At vero eos et accusam et justo duo
                        dolores et ea rebum. Stet clita kasd gubergren, no sea takimata sanctus est Lorem ipsum dolor sit amet.
                        Lorem ipsum dolor sit amet, consetetur sadipscing elitr, sed diam nonumy eirmod tempor invidunt ut
                        labore et dolore magna aliquyam erat, sed diam voluptua.</p>
                </div>
            </div>
        </div>
        <div class="col-xs-12 col-sm-12 col-md-6 col-lg-4">
            <div class="card">
                <div class="cardImageContainer">
                    <?php echo Html::img('@web/' . $imagePath, ['alt'=>'weingarten', 'class'=>'cardImage']); ?>
                </div>

                <div class="cardHeadline">
                    <h1> Meine Aktuelles Ding</h1>
                </div>
                <div class="cardText">
                    <p>Lorem ipsum dolor sit amet, consetetur sadipscing elitr, sed diam nonumy eirmod tempor invidunt
                        ut labore et dolore magna aliquyam erat, sed diam voluptua. At vero eos et accusam et justo duo
                        dolores et ea rebum. Stet clita kasd gubergren, no sea takimata sanctus est Lorem ipsum dolor sit amet.
                        Lorem ipsum dolor sit amet, consetetur sadipscing elitr, sed diam nonumy eirmod tempor invidunt ut
                        labore et dolore magna aliquyam erat, sed diam voluptua.</p>
                </div>
            </div>
        </div>
    </div>
</div>
<script>

</script>








