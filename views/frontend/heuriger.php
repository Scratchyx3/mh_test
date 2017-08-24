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

$this->title = 'Heuriger';

$imageMdl = new Image();
$imageMdl -> type = 'heuriger';
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
            <h1> Unser Heuriger </h1>
        </div>
        <div class="textContent">
            <p>
                Bei sonnigem Wetter findet der Besucher einen schattigen Platz im schönen Obstgarten,
                bei Schlechtwetter genießt er Heurigenspezialitäten
                (Wildschweinschinken, selbstgemachtes G'selchtes, verschiedene Aufstriche, selbstgemachten Mehlspeisen etc.)
                und unsere Weine im gemütlichen Lokal. Reisegruppen sind auch wochentags gegen Voranmeldung herzlich willkommen! <br><br>

                Ein idealer Ort, um einen Ausflug in die bekannten Weinbaugebiete
                <?= Html::a('Wagram', 'https://www.donau.com/de/wagram/', ['target' => '_blank', 'class'=>'']) ?>
                und
                <?= Html::a('Kamptal', 'http://www.kamptal.at/', ['target' => '_blank', 'class'=>'']) ?>
                ausklingen zu lassen.
                Das
                <?= Html::a('Muskifestival Grafenegg', 'http://www.grafenegg.com/de', ['target' => '_blank', 'class'=>'']) ?>
                ,die
                <?= Html::a('Schlossfestspiel in Haindorf', 'http://www.operettensommer.at/', ['target' => '_blank', 'class'=>'']) ?>
                , das <?= Html::a('Loisium', 'http://www.loisium.com/', ['target' => '_blank', 'class'=>'']) ?> in Langenlois,
                die Altstadt von <?= Html::a('Krems', 'http://www.krems.gv.at/', ['target' => '_blank', 'class'=>'']) ?> ,
                <?= Html::a('Schaugärten in Schiltern', 'http://www.cusoon.at/kittenberger-erlebnisgaerten', ['target' => '_blank', 'class'=>'']) ?>
                , die Messestadt <?= Html::a('Tulln', 'https://www.tulln.at/', ['target' => '_blank', 'class'=>'']) ?> freuen sich über viele Besucher.
                Auch Besucher des <?= Html::a('Weinviertler Jakobsweg', 'https://www.jakobsweg-weinviertel.at/', ['target' => '_blank', 'class'=>'']) ?>
                wandern bei unserem Heurigen vorbei,
                und auch viele <?= Html::a('Radwege', 'http://www.fahr-radwege.com/Wagramweg.htm', ['target' => '_blank', 'class'=>'']) ?> sind in der Nähe. <br>

                Informationen auch unter: <?= Html::a('www.donau.com', 'http://www.donau.com', ['target' => '_blank', 'class'=>'']) ?>. <br><br>

                Sie finden uns auch im <?= Html::a('Niederösterreicher Guide', 'http://www.niederoesterreicher-guide.at/vcard/480/winzerhof-u-heuriger-mayer-hoermann', ['target' => '_blank', 'class'=>'']) ?>. <br><br>

                Unser Heuriger wurde zum wiederholten mal getestet: <?= Html::a('www.restauranttester.at/mayer-hoermann', 'http://www.restauranttester.at/mayer-hormann.html', ['target' => '_blank', 'class'=>'']) ?>. <br><br>

                Selbstverständlich können Sie alle unsere Weine verkosten und zu "AB-Hof Preisen" kaufen.
            </p>
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






