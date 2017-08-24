<?php
/**
 * Created by PhpStorm.
 * User: Christoph Rohrmoser
 * Date: 21.06.2017
 * Time: 13:49
 */

use app\models\Image;
use yii\helpers\Html;
use yii\helpers\Url;

traversient\yii\customscrollbar\AssetBundle::register($this);

$this->title = 'Weinkeller';

$imageMdl = new Image();
$imageMdl -> type = 'weinkeller';
$rndImages = $imageMdl -> getRndImages(10);

$items = array();

foreach ($rndImages as $image) {
    $thumbnailUrl = Url::to([$image->path . $image->thumbnailName]);
    $imageUrl = Url::to([$image->path . $image->name]);
    array_push($items, ['div' => 'itemDiv', 'url' => $imageUrl, 'src' =>  $thumbnailUrl, 'options' =>['title' => $image->name]]);
}
$options = ['class' => 'galleryContainer'];

?>

<div class="container-fluid">
    <div class="row">
    <div id="myGallery">
        <?= dosamigos\gallery\Gallery::widget(['options' => $options, 'items' => $items]);?>
    </div>
    </div>

</div>
<div class="container">
    <div class="row">
        <div class="textHeadline">
            <h1> Unser Weinkeller </h1>
        </div>
        <div class="textContent">
            <p>Die Betrieb befindet sich in der Kirchengasse 17.
                Der Weinkeller ist das Herzstück des Betriebes. Der unterkellerte Hof bildet ein verwinkeltes Gangsystem mit vielen Tanks und Fässern.
                Auf die schonende Behandlung der Moste wird sehr viel Wert gelegt,
                sie werden geklärt und mit Hefen versetzt und während der Gärung gekühlt,
                dass möglichst viele Bukettstoffe erhalten bleiben.
                Die Weißweine lagern in Edelstahltanks und die Rotweine in traditionellen Holzfässern.
                Die Jahrgangsabfüllung erfolgt im März mit einer vollautomatischen Füllanlage.
                Der ältere Teil des Kellers ist mindestens 200 Jahre alt. In diesem Teil befindet sich auch die Vinothek.
                Die Barriquefässer beziehen wir von der
                <?= Html::a('Fassbinderei Benninger', 'http://www.fassbinder.at', ['target' => '_blank', 'class'=>'']) ?> und der
                <?= Html::a('Fassbinderei Kalina', 'http://www.holzfasser.com', ['target' => '_blank', 'class'=>'']) ?>.
                Derzeit reift unser Zweigelt Barrique (Barrique vom Zweigelt & Shiraz) in der Fässern.</p>
        </div>

    </div>
</div>

<?php
// enable custom scroll bars
$this->registerJs(
    '(function($){
			$(window).on("load",function(){
				
				$("#myGallery").mCustomScrollbar({
					theme:"inset",
					autoHideScrollbar: false,
					axis:"x",
					alwaysShowScrollbar: 0
				});
				
			});
		})(jQuery);'
);
?>
