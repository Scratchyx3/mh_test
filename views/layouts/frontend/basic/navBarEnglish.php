<?php
/**
 * Created by PhpStorm.
 * User: Christoph Rohrmoser
 * Date: 16.11.2017
 * Time: 13:20
 */

use yii\helpers\Html;
use yii\helpers\Url;

$linkToGermanVersion = Url::to('/site/index');
$linkToEnglishVersion = Url::to('/site/english');

?>

<nav id="navigationHeader" class="container-fluid">
    <div class="row">
        <div class="container">
            <div class="logoMH hidden-xs col-sm-6">
                <a id="menuStartseiteLink" href="<?=$linkToEnglishVersion?>"><h1>Mayer-Hörmann</h1></a>
            </div>

            <div class="logoShop col-sm-6 pull-right">
                <?php echo Html::img('@web/image/icon_shop.png', ['alt'=>'shop icon', 'id'=>'iconShop', 'class'=>'pull-right']); ?>
                <button id="shopButton" type="button" class="btn btn-default pull-right"><h1> Wine Shop </h1></button>
                <a id="linkAustria" href="<?=$linkToGermanVersion?>" class="pull-right">
                    <?php echo Html::img('@web/image/icon/icon_austria.png', ['alt'=>'german', 'id'=>'iconAustria', 'class'=>'pull-right']); ?>
                </a>
            </div>
        </div>
    </div>
</nav>


