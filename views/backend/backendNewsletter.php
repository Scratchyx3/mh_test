<?php
/**
 * Created by PhpStorm.
 * User: Christoph Rohrmoser
 * Date: 18.09.2017
 * Time: 12:07
 */

use app\models\Email;
use yii\bootstrap\Html;
use yii\data\ActiveDataProvider;
use yii\grid\GridView;
use yii\helpers\Url;
use yii\widgets\Pjax;

?>
<div class="container">
    <div class="row" id="row_newsletter">
        <div class="col-xs-12">
            <h1> Anmeldungen für den Newsletter </h1><?php
          $dataProvider = new ActiveDataProvider([
              'query' => Email::find(),
              'pagination' => [
                  'pageSize' => 500,
              ],
          ]);
          Pjax::begin();
          echo GridView::widget([
              'dataProvider' => $dataProvider,
              'columns' => [
                  [
                      'attribute' => 'email',
                      'format' => 'text'
                  ],
                  [
                      'header' => 'Aktionen',
                      'class' => 'yii\grid\ActionColumn',
                      'template' => '{delete}',
                      'buttons' => [
                          'delete' => function ($url, $model) {
                              $url = Url::to(['backend/delete-newsletter-email', 'id' => $model->id]);
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