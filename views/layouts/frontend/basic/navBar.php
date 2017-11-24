<?php
/**
 * Created by PhpStorm.
 * User: Christoph Rohrmoser
 * Date: 21.06.2017
 * Time: 12:41
 */

use yii\bootstrap\Nav;
use yii\bootstrap\NavBar;
use yii\helpers\Html;
use yii\helpers\Url;

$startseiteUrl = Url::to('/site/index');
$linkToEnglishVersion = Url::to('/site/english');

?>

<nav id="navigationHeader" class="container-fluid">
    <div class="row">
        <div class="container">
            <div class="logoMH hidden-xs col-sm-6">
                <a id="menuStartseiteLink" href="<?=$startseiteUrl?>"><h1>Mayer-Hörmann</h1></a>
            </div>

            <div class="logoShop col-sm-6 pull-right">
                <?php echo Html::img('@web/image/icon_shop.png', ['alt'=>'shop icon', 'id'=>'iconShop', 'class'=>'pull-right']); ?>
                <button id="shopButton" type="button" class="btn btn-default pull-right"><h1>Wein kaufen</h1></button>
                <a id="linkUk" href="<?=$linkToEnglishVersion?>" class="pull-right">
                    <?php echo Html::img('@web/image/icon/icon_uk.png', ['alt'=>'english', 'id'=>'iconUk', 'class'=>'pull-right']); ?>
                </a>
            </div>
        </div>
    </div>
</nav>

<?php
NavBar::begin([
    'brandLabel' => 'Mayer-Hörmann',
    'options' => [
        'class' => 'navbar navbar-inverse navbar-fixed-top',
        'id' => 'navBar'
    ],
]);

echo Nav::widget([
    'options' => [
        'class' => 'navbar-nav',
        'id' => 'navBarUl'
    ],
    'items' => [
        ['label' => 'Startseite', 'url' => ['/site/index']],
        ['label' => 'Anfahrt', 'url' => ['/site/anfahrt']],
        ['label' => 'Heuriger', 'url' => ['/site/heuriger']],
        ['label' => 'Weinkeller', 'url' => ['/site/weinkeller']],
        ['label' => 'Weinkarte', 'url' => Url::to(['file_upload/weinkarte/weinkarte.pdf']), 'linkOptions' => ['target' => '_blank']],
        ['label' => 'Lagen', 'url' => ['/site/lagen']],
        ['label' => 'Auszeichnungen', 'url' => ['/site/auszeichnungen']],
    ],
]);
NavBar::end();
?>

