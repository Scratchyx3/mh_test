<?php
/**
 * Created by PhpStorm.
 * User: Christoph Rohrmoser
 * Date: 21.06.2017
 * Time: 13:49
 */

use app\models\Image\ImageFactory;
use app\models\OpeningHour;
use yii\helpers\Html;
use yii\helpers\Url;

traversient\yii\customscrollbar\AssetBundle::register($this);

// ============== opening hours ====================
$events = OpeningHour::find()->where(['event' => 1])->orderBy('from_date')->all();
$openingHours = OpeningHour::find()->where(['event' => 0])->orderBy('from_date')->all();

$this->title = 'Heuriger';

$imageMdl = ImageFactory::create('galleryImage', 'heuriger');
$rndImages = $imageMdl->getRandomImage();

$items = array();

foreach ($rndImages as $image) {
    $thumbnailUrl = Url::to([$image['path'] . $image['thumbnailName']]);
    $imageUrl = Url::to([$image['path'] . $image['name']]);
    array_push($items, ['div' => 'itemDiv', 'url' => $imageUrl, 'src' =>  $thumbnailUrl, 'options' =>['title' => $image['name']]]);
}

$options = ['class' => 'galleryContainer'];

$headline = $model->headline;
$text = $model->content;
$text = str_replace('&nbsp;', ' ', $text);

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
        <div class="col-xs-0 col-sm-0 col-md-2 col-lg-2"> </div>
        <div class="col-xs-12 col-sm-12 col-md-8 col-lg-8">
            <div class="openingHours">
                <h1> Unsere Heurigen-Öffnungszeiten </h1>
                <?php
                foreach ($openingHours as $openingHour) {
                    echo "<p>" .
                        Yii::$app->formatter->asDate($openingHour->from_date, 'php: d. M Y') .
                        " - " .
                        Yii::$app->formatter->asDate($openingHour->to_date, 'php: d. M Y') .
                        "</p>";
                }

                foreach ($events as $event) {
                    echo "<p><b>" .
                        $event->event_name . "</b>: " .
                        Yii::$app->formatter->asDate($event->from_date, 'php: d. M Y') .
                        " - " .
                        Yii::$app->formatter->asDate($event->to_date, 'php: d. M Y') .
                        "</p>";
                }
                ?>
                <p>(täglich ab 15:00 Uhr geöffnet)</p>
                <?= Html::a('Unsere Speisekarte', [Url::to(['file_upload/speisekarte/speisekarte.pdf'])], ['target' => '_blank']) ?>
            </div>
        </div>
        <div class="col-xs-0 col-sm-0 col-md-2 col-lg-2"> </div>
    </div>
    <div class="row">
        <div class="col-xs-0 col-sm-0 col-md-2 col-lg-2"> </div>
        <div class="col-xs-12 col-sm-12 col-md-8 col-lg-8">
            <div class="textContent">
                <?php echo "<h1>" . $headline . "</h1>"; ?>
                <p>
                <?= $text ?>
                </p>
            </div>
        </div>
        <div class="col-xs-0 col-sm-0 col-md-2 col-lg-2"> </div>
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






