<?php
/**
 * Created by PhpStorm.
 * User: Christoph Rohrmoser
 * Date: 03.07.2017
 * Time: 14:23
 */

use app\models\Image;
use dosamigos\ckeditor\CKEditor;
use kartik\file\FileInput;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\widgets\ActiveForm;

$imageMdl = new Image();
$imageMdl->type = 'lagen';
$imageMdl -> setPath();
// get all images from database
$images = $imageMdl -> find()->where(['type' => 'lagen'])->all();

$initialPreviewData = array();
$initialPreviewConfigData = array();

foreach ($images as $image) {
    // get image paths from database for initial preview
    $imagePath = Url::to(['/image/uploads/' . $image->type . '/' . $image->thumbnailName]);
    array_push($initialPreviewData, $imagePath);
    // set up delete button url and match the image ids
    array_push($initialPreviewConfigData, ['type' => 'image', 'url' => '/backend/image-delete', 'key' => $image->id, 'caption' => $image->name, 'size' => $image->size]);
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
                            'imageType' => 'lagen',
                        ],
                    'resizeImage' => true,
                ]
            ]);
            ?>
        </div>
    </div>

    <div class="row">
        <div class="textEditor">
            <?php
            $form = ActiveForm::begin([
                    'id' => 'card',
                    'action' => ['backend/card-upload'],
                    'options' => ['method' => 'post', 'class' => 'form-horizontal'],
            ])
            ?>
            <?= $form->field($model, 'content')->widget(CKEditor::className(), [
                'options' => ['rows' => 6],
                'preset' => 'basic'
            ]) ?>
            <?= $form->field($model, 'headline')->textInput()->hint('Please enter your name')->label('Name') ?>
            <?= $form->field($model, 'fkImage')->textInput()->hint('Please enter your name')->label('Name') ?>
            <?= $form->field($model, 'instagramLink')->textInput()->hint('Please enter your name')->label('Name') ?>

            <?= Html::submitButton('Login', ['class' => 'btn btn-primary']) ?>
            <?php ActiveForm::end() ?>


        </div>
    </div>

</div>

