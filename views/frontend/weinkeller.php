<?php
/**
 * Created by PhpStorm.
 * User: Christoph Rohrmoser
 * Date: 21.06.2017
 * Time: 13:49
 */

use app\models\Image;
use yii\helpers\Url;

traversient\yii\customscrollbar\AssetBundle::register($this);

$this->title = 'Weinkeller';

?>

<div class="container-fluid">
    <div class="row">
    <?php

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
    <div id="myGallery">
        <?= dosamigos\gallery\Gallery::widget(['options' => $options, 'items' => $items]);?>
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
