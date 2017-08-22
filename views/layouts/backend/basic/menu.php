<?php
/**
 * Created by PhpStorm.
 * User: Christoph Rohrmoser
 * Date: 13.07.2017
 * Time: 13:11
 */

use yii\helpers\Html;
use yii\helpers\Url;

$url = Url::to('/admin');
?>

<div class="menu" class="row">
    <div class="container">
        <a href= <?=$url?> > <div class="backToMenu pull-left"> </div> </a>
        <?= Html::a('Logout', ['login/logout'], ['data' => ['method' => 'post'], 'id' => 'logoutButton', 'class' => 'pull-right']) ?>
    </div>
</div>
