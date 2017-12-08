<?php
/**
 * Created by PhpStorm.
 * User: Christoph Rohrmoser
 * Date: 27.06.2017
 * Time: 11:20
 */

use app\models\Card;
use app\models\Image\ImageFactory;
use traversient\yii\customscrollbar\AssetBundle;
use yii\helpers\Url;

AssetBundle::register($this);

$this->title = 'Partner';

$imageMdl = ImageFactory::create('titleImage', 'partner');
$image = $imageMdl -> getRandomImage();
if (empty($image)) {
    $imagePath = Url::to('/' . Yii::$app->params[0]['fallbackImagePath']);
} else {
    $imagePath = Url::to('/' . $image[0]['path'] . $image[0]['name']);
}

$cardMdl = new Card();
$cardMdlArray = $cardMdl->find()->where(['imageType' => 'card_partner'])->orderBy(['id'=>SORT_DESC])->all();
$imageMdl = ImageFactory::create('cardImage', 'card_partner');
?>

<a id="linkIconDown" href="#headlineAuszeichnungen">
    <div class="iconDown"> </div>
</a>

<div class="container-fluid">
    <div class="row">
        <div class="titleImageContainer" style='background-image: url(<?= $imagePath ?>);'></div>
    </div>
    <div id="row">
        <div id="headlineAuszeichnungen" class="row headline">
            <h1> Partner </h1>
        </div>
    </div>
</div>

<div id="contentUeberUns" class="container">
    <div class="row">
        <?php
        $count = 0;
        foreach($cardMdlArray as $cardMdl) {
            if ($cardMdl->published == 1) {
                // get text and remove unwanted spaces caused by text editor plugin
                $text = $cardMdl->content;
                $text = str_replace('&nbsp;', ' ', $text);
                // get card image if set / otherwise get fallback image
                if(!empty($cardMdl->fkImage)) {
                    $imageMdl = $imageMdl->findOne($cardMdl->fkImage);
                    $cardImagePath = $imageMdl->path . $imageMdl->name;
                } else {
                    $cardImagePath = Yii::$app->params[0]['fallbackImagePath'];
                }
                // if card is published
                echo "<div class='col-xs-12 col-sm-12 col-md-12 col-lg-12'>";
                echo "<div class='cardPartner'>";
                if(isset($cardMdl->instagramLink) && !empty($cardMdl->instagramLink)) {
                    echo "<a class='disableLink' target='_blank' href='" . $cardMdl->instagramLink . "'>";
                    if ($count % 2 == 0) {
                        echo "<img src='" . Url::to('/' . $cardImagePath) . "' class='cardPartnerImage'>";
                    } else {
                        echo "<img src='" . Url::to('/' . $cardImagePath) . "' class='cardPartnerImage pull-right'>";
                    }

                    echo "</a>";
                } else {
                    if ($count % 2 == 0) {
                        echo "<img src='" . Url::to('/' . $cardImagePath) . "' class='cardPartnerImage'>";
                    } else {
                        echo "<img src='" . Url::to('/' . $cardImagePath) . "' class='cardPartnerImage pull-right'>";
                    }
                }
                echo ($count % 2 == 0) ? "<div class='cardPartnerText'>" :  "<div class='cardPartnerText pull-left'>";
                echo "<h1>" . $cardMdl->headline . "</h1>";
                echo "<p>" . $text . "</p>";
                echo "</div>";
                echo "</div>";
                echo "</div>";
            }
            $count++;
        }
        ?>
    </div>
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