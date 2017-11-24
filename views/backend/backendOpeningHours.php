<?php
/**
 * Created by PhpStorm.
 * User: Christoph Rohrmoser
 * Date: 07.11.2017
 * Time: 16:39
 */
use app\models\OpeningHour;
use yii\data\ActiveDataProvider;
use yii\grid\GridView;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\jui\DatePicker;
use yii\widgets\ActiveForm;
use yii\widgets\Pjax;

?>

<div class="container">
    <div class="row">
        <div class="col-xs-12">
            <h1> Öffnungszeiten Heuriger hinzufügen </h1>
            <?php
            $form = ActiveForm::begin([
                'id' => 'card',
                'action' => ['backend/save-opening-hour'],
                'options' => ['method' => 'post', 'class' => 'form-horizontal'],
            ]) ?>

            <?= $form->field($model, 'input_from_date',['template' => "{label}<br>{input}{error}{hint}"])->label('Anfang')->widget(DatePicker::classname(), [
                'dateFormat' => 'php:d. M Y',
                'options' => [
                    'id' => 'opening_hour_from_date'
                ],

            ]) ?>

            <?= $form->field($model, 'input_to_date',['template' => "{label}<br>{input}{error}{hint}"])->label('Ende')->widget(DatePicker::classname(), [
                'dateFormat' => 'php:d. M Y',
                'options' => [
                    'id' => 'opening_hour_to_date'
                ],
            ]) ?>

            <?= $form->field($model, 'event')->hiddenInput(['value'=> 0])->label(false) ?>

            <?= Html::submitButton('Speichern', ['class' => 'btn btn-primary']) ?>
            <?php ActiveForm::end() ?>
        </div>
    </div>
    <div class="row">
        <div class="col-xs-12">
            <h1> Event hinzufügen (Weinherbst, Advent, ...) </h1>
            <?php
            $form = ActiveForm::begin([
                'id' => 'card',
                'action' => ['backend/save-opening-hour'],
                'options' => ['method' => 'post', 'class' => 'form-horizontal'],
            ]) ?>

            <?= $form->field($model, 'event_name')->label('Event-Name') ?>

            <?= $form->field($model, 'input_from_date',['template' => "{label}<br>{input}{error}{hint}"])->label('Anfang')->widget(DatePicker::classname(), [
                'dateFormat' => 'php:d. M Y',
                'options' => [
                    'id' => 'event_from_date'
                ],
            ]) ?>

            <?= $form->field($model, 'input_to_date',['template' => "{label}<br>{input}{error}{hint}"])->label('Ende')->widget(DatePicker::classname(), [
                'dateFormat' => 'php:d. M Y',
                'options' => [
                    'id' => 'event_to_date'
                ],
            ]) ?>

            <?= $form->field($model, 'event')->hiddenInput(['value'=> 1])->label(false) ?>

            <?= Html::submitButton('Speichern', ['class' => 'btn btn-primary']) ?>
            <?php ActiveForm::end() ?>
        </div>
    </div>

    <div class="row">
        <div class="col-xs-12">
            <h1> Öffnungszeiten </h1>
            <?php

            $dataProvider = new ActiveDataProvider([
                'query' => OpeningHour::find()->orderBy('from_date'),
                'pagination' => [
                    'pageSize' => 500,
                ],
                'sort' => [
                    'attributes' => [
                        'from_date',
                    ],
                ],
            ]);
            Pjax::begin();
            echo GridView::widget([
                'dataProvider' => $dataProvider,
                'columns' => [
                    [
                        'header' => 'Start',
                        'attribute' => 'from_date',
                        'format' => ['date', 'php: d. M Y']
                    ],
                    [
                        'header' => 'Ende',
                        'attribute' => 'to_date',
                        'format' => ['date', 'php: d. M Y']
                    ],
                    [
                        'attribute' => 'event_name',
                        'format' => 'text'
                    ],
                    [
                        'header' => 'Aktionen',
                        'class' => 'yii\grid\ActionColumn',
                        'template' => '{delete}',
                        'buttons' => [
                            'delete' => function ($url, $model) {
                                $url = Url::to(['backend/delete-opening-hour', 'id' => $model->id]);
                                return Html::a('<span class="glyphicon glyphicon-trash"></span>', $url, ['title' => 'delete']);
                            },
                        ]
                    ],
                ],
            ]);
            Pjax::end();
            ?>
        </div>
    </div>
</div>
