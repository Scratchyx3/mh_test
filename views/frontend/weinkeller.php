<?php
/**
 * Created by PhpStorm.
 * User: Christoph Rohrmoser
 * Date: 21.06.2017
 * Time: 13:49
 */

use app\models\Image\ImageFactory;
use yii\helpers\Url;

traversient\yii\customscrollbar\AssetBundle::register($this);

// ============== meta tags ====================
$this->title = 'Winzerhof Mayer-Hörmann | Weinkeller in Engabrunn';
$this->registerMetaTag([
    'name' => 'description',
    'content' => 'Im Weinkeller des Winzerhofes Mayer-Hörmann kann man schenll die Zeit vergessen, wenn man mit den Winzern den Wein verkostet.',
]);

$imageMdl = ImageFactory::create('galleryImage', 'weinkeller');
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




