<?php
/**
 * Created by PhpStorm.
 * User: Christoph Rohrmoser
 * Date: 18.09.2017
 * Time: 12:07
 */

use app\models\Image\ImageFactory;
use kartik\file\FileInput;
use yii\helpers\Url;

$imageMdl = ImageFactory::create('titleImage', 'impressum');
// get all images from database
$images = $imageMdl -> find()->where(['type' => $imageMdl->getType()])->all();

$initialPreviewData = array();
$initialPreviewConfigData = array();

foreach ($images as $image) {
    // get image paths from database for initial preview
    $imagePath = Url::to(['/image/uploads/' . $image->type . '/' . $image->thumbnailName]);
    array_push($initialPreviewData, $imagePath);
    // set up delete button url and match the image ids
    array_push($initialPreviewConfigData, [
        'url' => '/backend/image-delete',
        'key' => $image->id,
        'caption' => $image->name,
        'size' => $image->size,
        'extra' => ['baseType' => 'titleImage', 'imageType' => 'impressum']]);
}

$imageMdl = ImageFactory::create('titleImage', 'impressum');

?>

<div class="container">
    <div class="row">
        <div class="col-xs-12">
            <h1> Titelbild Impressum </h1>
            <div class="bs-callout bs-callout-info">
                <h4> How-To </h4>
                <p>
                    1) Bild verkleinern auf ungefähr 1900 - 2000 Pixel Breite. <br>
                    2) <a href="https://tinypng.com/" target="_blank"> Bild online komprimieren </a> <br>
                    3) Dateiname anpassen (z.B. Weingarten, Traubenernte, Weinkeller, ...) <br>
                    4) Bild uploaden
                </p>
            </div>
            <?php
            echo FileInput::widget([
                'model' => $imageMdl,
                'attribute' => 'imageFiles[]',
                'language' => 'de',
                'options'=>[
                    'multiple'=>true,
                ],
                'pluginOptions' => [
                    'maxFileSize' => 3000,
                    'theme' => 'explorer-fa',
                    'previewFileType' => 'image',
                    'overwriteInitial'=>false,
                    'initialPreviewAsData'=>true,
                    'initialPreview'=> $initialPreviewData,
                    'initialPreviewConfig' => $initialPreviewConfigData,
                    'uploadUrl' => Url::to(['/backend/image-upload']),
                    'maxFileCount' => 10,
                    'uploadExtraData' =>
                        [
                            'baseType' => 'titleImage',
                            'imageType' => 'impressum',
                        ],
                    'resizeImage' => true,
                ]
            ]);
            ?>
        </div>
    </div>