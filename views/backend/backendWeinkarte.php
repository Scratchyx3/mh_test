<?php
/**
 * Created by PhpStorm.
 * User: Christoph Rohrmoser
 * Date: 03.07.2017
 * Time: 14:23
 */

use app\models\File;
use kartik\file\FileInput;
use yii\helpers\Url;

$initialPreviewData = array();
$initialPreviewConfigData = array();

// get all images from database
if ($fileMdl = File::find()->where(['type' => 'weinkarte'])->one()) {
    // get image paths from database for initial preview
    array_push($initialPreviewData,  Url::to([$fileMdl->path . $fileMdl->name]));
    // set up delete button url and match the image ids
    array_push($initialPreviewConfigData, ['type' => 'pdf', 'url' => '/backend/file-delete', 'key' => $fileMdl->id, 'caption' => $fileMdl->name]);
}

$fileMdl = new File();
?>

<div class="container">
    <div class="row">
        <div class="col-xs-12">
            <h1> Weinkarte </h1>
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
                            'fileType' => 'weinkarte',
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
</div>
