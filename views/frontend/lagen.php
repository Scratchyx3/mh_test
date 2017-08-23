<?php
/**
 * Created by PhpStorm.
 * User: Christoph Rohrmoser
 * Date: 21.06.2017
 * Time: 13:49
 */

use app\models\Image;
use yii\helpers\Url;

$this->title = 'Lagen';

$session = Yii::$app->session;
if (!$session->isActive) {
    $session->open();
}
// check if there is already a title image saved in session
if ($session->has('lagenTitleImage') && file_exists($session->get('lagenTitleImage'))) {
    $imagePath = $session->get('lagenTitleImage');
// get path to random title image
} else {
    $imageMdl = new Image();
    $imageMdl -> type = 'lagen';
    $imageMdl -> setPath();
    $imagePath = $imageMdl -> getRndImagePath();
    $session->set('lagenTitleImage', $imagePath);
}
$url = Url::to('@web/' . $imagePath);

?>

<div class="container-fluid">
    <div class="row">
        <div class="standardTitleImageContainer" style='background-image: url(<?= $url ?>);'></div>
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