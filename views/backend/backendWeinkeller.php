<?php
/**
 * Created by PhpStorm.
 * User: Christoph Rohrmoser
 * Date: 03.07.2017
 * Time: 14:23
 */

use app\models\Image\ImageFactory;
use dosamigos\ckeditor\CKEditor;
use kartik\file\FileInput;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\widgets\ActiveForm;

$imageMdl = ImageFactory::create('galleryImage', 'weinkeller');
// get all images from database
$images = $imageMdl -> find()->where(['type' => $imageMdl->getType()])->all();

$initialPreviewData = array();
$initialPreviewConfigData = array();

foreach ($images as $image) {
// get image paths from database for initial preview
$imagePath = Url::to(['/image/uploads/gallery_' . $image->type . '/' . $image->thumbnailName]);
array_push($initialPreviewData, $imagePath);
// set up delete button url and match the image ids
    array_push($initialPreviewConfigData, [
        'url' => '/backend/image-delete',
        'key' => $image->id,
        'caption' => $image->name,
        'size' => $image->size,
        'extra' => ['baseType' => 'galleryImage', 'imageType' => 'weinkeller']]);
}
?>

<div class="container">
    <div class="row">
        <div class="col-xs-12">
            <h1> Galerie Weinkeller </h1>
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
                            'baseType' => 'galleryImage',
                            'imageType' => 'weinkeller',
                        ],
                    'resizeImage' => true,
                ]
            ]);
            ?>
        </div>
    </div>
    <div class="row">
            <div class="col-xs-12">
                <h1> Überschrift und Text Weinkeller </h1>
                    <?php
                    $form = ActiveForm::begin([
                        'id' => 'card',
                        'action' => ['backend/card-upload'],
                        'options' => ['method' => 'post', 'class' => 'form-horizontal'],
                    ]) ?>

                    <?= $form->field($model, 'headline')->label('Überschrift')->textInput() ?>

                    <?= $form->field($model, 'content')->label('Text')->widget(CKEditor::className(), [
                        'options' => ['rows' => 6],
                        'preset' => 'basic',
                    ]) ?>

                    <?= $form->field($model, 'id')->hiddenInput(['value'=> $model->id])->label(false) ?>
                <?= $form->field($model, 'baseType')->hiddenInput(['value'=> 'cardImage'])->label(false) ?>
                <?= $form->field($model, 'imageType')->hiddenInput(['value'=> 'card_weinkeller'])->label(false) ?>

                    <?= Html::submitButton('Bestätigen', ['class' => 'btn btn-primary']) ?>
                    <?php ActiveForm::end() ?>
            </div>
    </div>
</div>

