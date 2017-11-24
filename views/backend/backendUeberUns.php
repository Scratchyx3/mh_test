<?php
/**
 * Created by PhpStorm.
 * User: Christoph Rohrmoser
 * Date: 14.11.2017
 * Time: 11:45
 */

use app\models\Image\ImageFactory;
use kartik\file\FileInput;
use yii\helpers\Url;

$imageMdl = ImageFactory::create('titleImage', 'lagen');

// get all images from database
$images = $imageMdl -> find()->where(['type' => 'ueber_uns'])->all();

$initialPreviewData = array();
$initialPreviewConfigData = array();

foreach ($images as $image) {
// get image paths from database for initial preview
$imagePath = Url::to(['/image/uploads/' . $image->type . '/' . $image->thumbnailName]);
array_push($initialPreviewData, $imagePath);
// set up delete button url and match the image ids
array_push($initialPreviewConfigData, [
'type' => 'image',
'url' => '/backend/image-delete',
'key' => $image->id,
'caption' => $image->name,
'size' => $image->size,
'extra' => ['baseType' => 'titleImage', 'imageType' => 'ueber_uns']]);
}
?>

<div class="container">
    <div class="row">
        <div class="col-xs-12">
            <h1> Titelbild Lagen </h1>
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
                            'imageType' => 'ueber_uns',
                        ],
                    'resizeImage' => true,
                ]
            ]);
            ?>
        </div>
    </div>