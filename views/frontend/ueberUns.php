<?php
/**
 * Created by PhpStorm.
 * User: Christoph Rohrmoser
 * Date: 27.06.2017
 * Time: 11:20
 */

use app\models\Image\ImageFactory;
use yii\helpers\Url;

$this->title = 'Über uns';

$imageMdl = ImageFactory::create('titleImage', 'ueber_uns   ');
$image = $imageMdl -> getRandomImage();
if (empty($image)) {
    $imagePath = Url::to('/' . Yii::$app->params[0]['fallbackImagePath']);
} else {
    $imagePath = Url::to('/' . $image[0]['path'] . $image[0]['name']);
}
?>

<a id="linkIconDown" href="#contentUeberUns">
    <div class="iconDown"> </div>
</a>

<div class="container-fluid">
    <div class="row">
        <div class="titleImageContainer" style='background-image: url(<?= $imagePath ?>);'></div>
    </div>
</div>

<div id="contentUeberUns" class="container">

</div>
<?php
// smooth scroll for the icon down
$this->registerJs('$("#linkIconDown").click(function(){
   //Toggle Class
   $(".active").removeClass("active");
   $(this).closest("li").addClass("active");
   var theClass = $(this).attr("class");
   $("."+theClass).parent("li").addClass("active");
   //Animate
   $("html, body").stop().animate({
   scrollTop: $( $(this).attr("href") ).offset().top - 112
   }, 800);
   $("#linkKontakt").click();
   return false;
   });
   $(".scrollTop a").scrollTop();'
);
?>