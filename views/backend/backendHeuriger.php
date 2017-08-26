<?php
/**
 * Created by PhpStorm.
 * User: Christoph Rohrmoser
 * Date: 03.07.2017
 * Time: 14:23
 */

use app\models\File;
use app\models\Image;
use dosamigos\ckeditor\CKEditor;
use kartik\file\FileInput;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\widgets\ActiveForm;

$imageMdl = new Image();
$imageMdl->type = 'heuriger';
$imageMdl -> setPath();
// get all images from database
$images = $imageMdl -> find()->where(['type' => 'heuriger'])->all();

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
    <?php
    $initialPreviewData = array();
    $initialPreviewConfigData = array();

    // get all images from database
    if ($fileMdl = File::find()->where(['type' => 'speisekarte'])->one()) {
        // get image paths from database for initial preview
        array_push($initialPreviewData,  Url::to([$fileMdl->path . $fileMdl->name]));
        // set up delete button url and match the image ids
        array_push($initialPreviewConfigData, ['type' => 'pdf', 'url' => '/backend/file-delete', 'key' => $fileMdl->id, 'caption' => $fileMdl->name]);
    }

    $fileMdl = new File();
    ?>

    <div class="row">
        <div class="col-xs-12">
            <h1> Speisekarte </h1>
            <?php
            echo FileInput::widget([
                'model' => $fileMdl,
                'attribute' => 'file',
                'language' => 'de',
                'options'=>[
                    'multiple'=>false,
                ],
                'pluginOptions' => [
                    'maxFileSize' => 3000,
                    'theme' => 'explorer-fa',
                    'previewFileType' => 'image',
                    'overwriteInitial'=>false,
                    'initialPreviewAsData'=>true,
                    'initialPreview'=> $initialPreviewData,
                    'initialPreviewConfig' => $initialPreviewConfigData,
                    'uploadUrl' => Url::to(['/backend/file-upload']),
                    'maxFileCount' => 1,
                    'uploadExtraData' =>
                        [
                            'fileType' => 'speisekarte',
                        ],
                    'resizeImage' => true,
                    'preferIconicPreview' => true,
                    'previewFileIconSettings' => [
                        'pdf' => '<i class="fa fa-file-pdf-o text-danger"></i>',
                    ]
                ]
            ]);
            ?>
        </div>
    </div>

    <?php
    $imageMdl->type = 'heuriger';
    $imageMdl -> setPath();
    // get all images from database
    $images = $imageMdl -> find()->where(['type' => 'heuriger'])->all();

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

    <div class="row">
        <div class="col-xs-12">
            <h1> Galerie Heuriger </h1>
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
                    'id'=>'image-imageFiles2',
                ],
                'pluginOptions' => [
                    'maxFileSize' => 10000,
                    'theme' => 'explorer-fa',
                    'previewFileType' => 'image',
                    'overwriteInitial'=>false,
                    'initialPreviewAsData'=>true,
                    'initialPreview'=> $initialPreviewData,
                    'initialPreviewConfig' => $initialPreviewConfigData,
                    'uploadUrl' => Url::to(['/backend/image-upload']),
                    'maxFileCount' => 100,
                    'uploadExtraData' =>
                        [
                            'imageType' => 'heuriger',
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
        ]) ?>

        <?= $form->field($model, 'headline')->textInput()->hint('Please enter your name')->label('Name') ?>

        <?= $form->field($model, 'content')->widget(CKEditor::className(), [
            'options' => ['rows' => 6],
            'preset' => 'basic'
        ]) ?>

        <?= $form->field($model, 'id')->hiddenInput(['value'=> $model->id])->label(false) ?>
        <?= $form->field($model, 'type')->hiddenInput(['value'=> 'heuriger'])->label(false) ?>

        <?= Html::submitButton('Login', ['class' => 'btn btn-primary']) ?>
        <?php ActiveForm::end() ?>
    </div>
</div>

</div>

