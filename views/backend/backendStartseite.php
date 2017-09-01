<?php
/**
 * Created by PhpStorm.
 * User: Christoph Rohrmoser
 * Date: 03.07.2017
 * Time: 14:23
 */

use app\models\Card;
use app\models\Image\ImageFactory;
use dosamigos\ckeditor\CKEditor;
use kartik\file\FileInput;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\widgets\ActiveForm;


$imageMdl = ImageFactory::create('titleImage', 'startseite');
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
        'extra' => ['baseType' => 'titleImage', 'imageType' => 'startseite']]);
}
?>

<div class="container">
    <div class="row">
        <div class="col-xs-12">
            <h1> Titelbild Startseite </h1>
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
                'imageType' => 'startseite',
            ],
        'resizeImage' => true,
    ]
]);
?>
        </div>
    </div>


<?php
    $imageMdl = ImageFactory::create('cardImage', 'card_startseite');
    $cardMdl = new Card();

?>
    <div class="row">
        <div class="col-xs-12">
            <h1> Neue Karte erstellen </h1>
            <div class="bs-callout bs-callout-info">
                <h4> How-To </h4>
                <p>
                    1) Bild verkleinern auf ungefähr 400 - 500 Pixel Breite. <br>
                    2) <a href="https://tinypng.com/" target="_blank"> Bild online komprimieren </a> <br>
                    3) Dateiname anpassen (z.B. Weingarten, Traubenernte, Weinkeller, ...) <br>
                    4) Überschrift und Text eingeben. <br>
                    5) Zum Speichern "Bestätigen" klicken.
                </p>
            </div>
            <?php
            $form = ActiveForm::begin([
                'id' => 'card',
                'action' => ['backend/card-upload'],
                'options' => ['method' => 'post', 'class' => 'form-horizontal'],
            ]) ?>
            <?php
            echo $form->field($imageMdl, 'imageFiles[]')->label('Bild')->widget(FileInput::classname(), [
                'options'=>[
                    'multiple'=>false,
                    'id'=>'image-imageFiles2',
                ],
                'language' => 'de',
                'pluginOptions' => [
                    'maxFileSize' => 10000,
                    'theme' => 'explorer-fa',
                    'maxFileCount' => 1,
                    'resizeImage' => true,
                    'showUpload' => false,
                ]
            ]); ?>

            <?= $form->field($cardMdl, 'instagramLink')->label('Instagram Link')->textInput() ?>
            <?= $form->field($cardMdl, 'baseType')->hiddenInput(['value'=> 'cardImage'])->label(false) ?>
            <?= $form->field($cardMdl, 'imageType')->hiddenInput(['value'=> 'card_startseite'])->label(false) ?>
            <?= $form->field($cardMdl, 'headline')->label('Überschrift')->textInput() ?>
            <?= $form->field($cardMdl, 'content')->label('Text')->widget(CKEditor::className(), [
                'options' => ['rows' => 6],
                'preset' => 'basic',
            ]) ?>
            <?= Html::submitButton('Bestätigen', ['class' => 'btn btn-primary']) ?>
            <?php ActiveForm::end() ?>
        </div>
    </div>
</div>





