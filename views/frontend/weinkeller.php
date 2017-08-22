<?php
/**
 * Created by PhpStorm.
 * User: Christoph Rohrmoser
 * Date: 21.06.2017
 * Time: 13:49
 */

use app\models\Image;
use yii\helpers\Html;
use yii\helpers\Url;

$session = Yii::$app->session;
if (!$session->isActive) {
    $session->open();
}
// check if there is already a title image saved in session
if ($session->has('weinkellerTitleImage') && file_exists($session->get('weinkellerTitleImage'))) {
    $imagePath = $session->get('weinkellerTitleImage');
// get path to random title image
} else {
    $imageMdl = new Image();
    $imageMdl -> type = 'weinkeller';
    $imageMdl -> setPath();
    $imagePath = $imageMdl -> getRndImagePath();
    $session->set('weinkellerTitleImage', $imagePath);
}

$this->title = 'Weinkeller';

?>

<div class="container-fluid">
    <div id="titleImageHeuriger" class="row standardTitleImageContainer">
        <?php echo Html::img('@web/' . $imagePath, ['alt'=>'weingarten', 'class'=>'standardTitleImage']); ?>
    </div>
    <div class="row">
    <?php

    $imageMdl = new Image();
    $imageMdl->type = 'gallery_weinkeller';
    $imageMdl -> setPath();
    // get all images from database
    $images = $imageMdl -> find()->where(['type' => $imageMdl->type])->all();

    $items = array();

    $items = array();

    foreach ($images as $image) {
        $thumbnailUrl = Url::to([$image->path . $image->thumbnailName]);
        $imageUrl = Url::to([$image->path . $image->name]);
        array_push($items, ['div' => 'itemDiv', 'url' => $imageUrl, 'src' =>  $thumbnailUrl, 'options' =>['title' => $image->name]]);
    }
    $options = ['class' => 'galleryContainer'];
    ?>
    <div id="myGallery">
        <?= dosamigos\gallery\Gallery::widget(['options' => $options, 'items' => $items]);?>
    </div>
    </div>

</div>

