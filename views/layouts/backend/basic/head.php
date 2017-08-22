<?php
/**
 * Created by PhpStorm.
 * User: Christoph Rohrmoser
 * Date: 21.06.2017
 * Time: 12:48
 */

use app\assets\BackendAsset;
use yii\helpers\Html;

BackendAsset::register($this);

?>
<!DOCTYPE html>
<html lang="<?= Yii::$app->language ?>">
<!--    BEGIN head-->
<head>
    <meta charset="<?= Yii::$app->charset ?>">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <?= Html::csrfMetaTags() ?>
    <title><?= Html::encode($this->title) ?></title>
    <!--    include google fonts-->
    <link href="https://fonts.googleapis.com/css?family=Lato" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Courgette" rel="stylesheet">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
    <link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet">
    <?php $this->head() ?>
</head>
