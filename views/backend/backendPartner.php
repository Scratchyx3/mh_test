<?php
/**
 * Created by PhpStorm.
 * User: Christoph Rohrmoser
 * Date: 14.11.2017
 * Time: 11:45
 */

use app\models\Card;
use app\models\Image\ImageFactory;
use dosamigos\ckeditor\CKEditor;
use kartik\file\FileInput;
use yii\data\ActiveDataProvider;
use yii\grid\GridView;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\widgets\ActiveForm;
use yii\widgets\Pjax;

?>

<div class="container">
    <?php
    $imageMdl = ImageFactory::create('cardImage', 'card_partner');
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
                    3) Link eingeben (z.B. www.orf.at)
                    4) Überschrift und Text eingeben. <br>
                    5) Speichern
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
            <?= $form->field($cardMdl, 'imageType')->hiddenInput(['value'=> 'card_partner'])->label(false) ?>
            <?= $form->field($cardMdl, 'headline')->label('Überschrift')->textInput() ?>
            <?= $form->field($cardMdl, 'content')->label('Text')->widget(CKEditor::className(), [
                'options' => ['rows' => 6],
                'preset' => 'full',
            ]) ?>
            <?= Html::submitButton('Speichern', ['class' => 'btn btn-primary']) ?>
            <?php ActiveForm::end() ?>
        </div>
    </div>

    <div class="row">
        <div class="col-xs-12">
            <h1> Vorhandene Karten editieren </h1>
            <?php

            $dataProvider = new ActiveDataProvider([
                'query' => Card::find()->where(['imageType' => 'card_partner'])->orderBy('ranking ASC'),
                'pagination' => [
                    'pageSize' => 500,
                ],
            ]);
            Pjax::begin([
                'enablePushState' => false,
                'enableReplaceState' => false,
            ]);
            echo GridView::widget([
                'dataProvider' => $dataProvider,
                'columns' => [
                    [
                        'attribute' => 'headline',
                        'format' => 'text'
                    ],
                    [
                        'header' => 'Aktionen',
                        'class' => 'yii\grid\ActionColumn',
                        'template' => '{edit} {publish} {rankUp} {rankDown} {delete}',
                        'buttons' => [
                            'edit' => function ($url, $model) {
                                $url = Url::to(['backend/edit-card', 'id' => $model->id, 'type' => 'partner']);
                                return Html::a('<span class="glyphicon glyphicon-edit"></span>', $url, ['title' => 'edit']);
                            },
                            'publish' => function ($url, $model) {
                                $url = Url::to(['backend/toggle-publish-card', 'id' => $model->id, 'type' => 'partner']);
                                if ($model->published == 1) {
                                    return Html::a('<span class="glyphicon glyphicon-eye-open paintRed"></span>', $url, ['title' => 'publish']);
                                } else {
                                    return Html::a('<span class="glyphicon glyphicon-eye-close paintGreen"></span>', $url, ['title' => 'publish']);
                                }
                            },
                            'rankUp' => function ($url, $model) {
                                $url = Url::to(['backend/rank-up-card', 'id' => $model->id, 'type' => 'partner', 'ranking' => $model->ranking]);
                                return Html::a('<span class="glyphicon glyphicon-arrow-up"></span>', $url, ['title' => 'rank up']);
                            },
                            'rankDown' => function ($url, $model) {
                                $url = Url::to(['backend/rank-down-card', 'id' => $model->id, 'type' => 'partner', 'ranking' => $model->ranking]);
                                return Html::a('<span class="glyphicon glyphicon-arrow-down"></span>', $url, ['title' => 'rank down']);
                            },
                            'delete' => function ($url, $model) {
                                $url = Url::to(['backend/delete-card', 'id' => $model->id, 'type' => 'partner']);
                                return Html::a('<span class="glyphicon glyphicon-trash"></span>', $url, ['title' => 'delete']);
                            },
                        ]
                    ],
                ],
            ]);

            $initialPreviewData = array();

            if(!empty($model->fkImage)) {
                $imageMdl = ImageFactory::create('cardImage', 'card_partner');
                $image = $imageMdl->findOne($model->fkImage);
                // get image paths from database for initial preview
                $imagePath = Url::to(['/image/uploads/' . $image->type . '/' . $image->name]);
                array_push($initialPreviewData, $imagePath);
            }

            $form = ActiveForm::begin([
                'id' => 'card',
                'action' => ['backend/card-upload'],
                'options' => ['method' => 'post', 'class' => 'form-horizontal'],
            ]) ?>
            <?php
            echo $form->field($imageMdl, 'imageFiles[]')->label('Bild')->widget(FileInput::classname(), [
                'options'=>[
                    'multiple'=>false,
                    'id'=>'image-imageFiles3',
                ],
                'language' => 'de',
                'pluginOptions' => [
                    'maxFileSize' => 10000,
                    'theme' => 'explorer-fa',
                    'maxFileCount' => 1,
                    'resizeImage' => true,
                    'showUpload' => false,
                    'initialPreviewAsData'=>true,
                    'initialPreview'=> $initialPreviewData,
                    'showRemove' => false,
                ]
            ]); ?>

            <?= $form->field($model, 'instagramLink')->label('Instagram Link')->textInput() ?>
            <?= $form->field($model, 'baseType')->hiddenInput(['value'=> 'cardImage'])->label(false) ?>
            <?= $form->field($model, 'imageType')->hiddenInput(['value'=> 'card_partner'])->label(false) ?>
            <?= $form->field($model, 'id')->hiddenInput(['value'=> $model->id])->label(false) ?>
            <?= $form->field($model, 'headline')->label('Überschrift')->textInput() ?>
            <?= $form->field($model, 'content')->label('Text')->widget(CKEditor::className(), [
                'options' => ['rows' => 6, 'id' => 'myCustomId'],
                'preset' => 'full',
            ]) ?>
            <?= Html::submitButton('Speichern', ['class' => 'btn btn-primary']) ?>
            <?php ActiveForm::end() ?>

            <?php
            Pjax::end();
            ?>
        </div>
    </div>