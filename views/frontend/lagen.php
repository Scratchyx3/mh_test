<?php
/**
 * Created by PhpStorm.
 * User: Christoph Rohrmoser
 * Date: 21.06.2017
 * Time: 13:49
 */

use app\models\Image\ImageFactory;
use yii\helpers\Url;

$this->title = 'Lagen';

$imageMdl = ImageFactory::create('titleImage', 'lagen');
$image = $imageMdl -> getRandomImage();
$imagePath = Url::to('/' . $image[0]['path'] . $image[0]['name']);

?>

<div class="container-fluid">
    <div class="row">
        <div class="standardTitleImageContainer" style='background-image: url(<?= $imagePath ?>);'></div>
    </div>
</div>
<?php
// enable custom scroll bars
$this->registerJs(
    '(function($){
			$(window).on("load",function(){
				
				$(".cardText").mCustomScrollbar({
					theme:"inset-dark",
					autoHideScrollbar: false,
					axis:"y",
					alwaysShowScrollbar: 0
				});
				
			});
		})(jQuery);'
);
?>