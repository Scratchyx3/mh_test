<?php
/**
 * Created by PhpStorm.
 * User: Christoph Rohrmoser
 * Date: 21.06.2017
 * Time: 13:49
 */

use app\models\Image;
use yii\helpers\Url;

$imageMdl = new Image();
$imageMdl -> type = 'auszeichnungen';
$rndTitleImage = $imageMdl -> getRndImages(1);
$imagePath = Url::to('/' . $rndTitleImage[0]->path . $rndTitleImage[0]->name);

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