<?php

use app\models\Card;
use app\models\Image\ImageFactory;
use traversient\yii\customscrollbar\AssetBundle;
use yii\helpers\Url;

AssetBundle::register($this);

$this->title = 'Winzerhof Mayer-Hörmann';

$imageMdl = ImageFactory::create('titleImage', 'startseite');
$image = $imageMdl -> getRandomImage();
if (empty($image)) {
    $imagePath = Url::to('/' . Yii::$app->params[0]['fallbackImagePath']);
} else {
    $imagePath = Url::to('/' . $image[0]['path'] . $image[0]['name']);
}

$imageMdl = ImageFactory::create('cardImage', 'card_startseite');

$cardMdl = new Card();
$cardMdlArray = $cardMdl->find()
    ->where(['and', 'imageType=:imageType', 'published=:published'])
    ->addParams([':imageType' => 'card_startseite', ':published' => 1])
    ->orderBy('ranking ASC')->all();
?>
<a id="linkIconDown" href="#headlineAktuelles">
    <div class="iconDown"> </div>
</a>

<div class="container-fluid">
    <div class="row">
        <div class="titleImageContainer" style='background-image: url(<?= $imagePath ?>);'></div>
    </div>
    <div id="row">
        <div class="row headlineBorderTop"></div>
        <div id="headlineAktuelles" class="row headline">
            <h1> Aktuelles </h1>
        </div>
        <div class="row headlineBorderBottom"></div>
    </div>
</div>

<div class="container">
    <div class="row">
        <?php
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
                echo "<div class='col-xs-12 col-sm-12 col-md-6 col-lg-6'>";
                echo "<div class='card'>";
                if(isset($cardMdl->instagramLink) && !empty($cardMdl->instagramLink)) {
                    echo "<a class='disableLink' target='_blank' href='" . $cardMdl->instagramLink . "'>";
                    echo "<div class='cardImageContainer' style='background: url(" . Url::to('/' . $cardImagePath) .
                        "); background-size: cover; background-position: center;' >";
                    echo "</div>";
                    echo "</a>";
                } else {
                    echo "<div class='cardImageContainer' style='background: url(" . Url::to('/' . $cardImagePath) .
                        "); background-size: cover; background-position: center;' >";
                    echo "</div>";
                }
                echo "<div class='cardText'>";
                echo "<h1>" . $cardMdl->headline . "</h1>";
                echo "<p>" . $text . "</p>";
                echo "</div>";
                echo "</div>";
                echo "</div>";
            }
        }
        ?>
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
// smooth scroll for the icon down
$this->registerJs(
'$("#linkIconDown").click(function(){
        //Toggle Class
        $(".active").removeClass("active");
        $(this).closest("li").addClass("active");
        var theClass = $(this).attr("class");
        $("."+theClass).parent("li").addClass("active");
        //Animate
        $("html, body").stop().animate({
            scrollTop: $( $(this).attr("href") ).offset().top - 111
        }, 800);
        $("#linkKontakt").click();
        return false;
    });
    $(".scrollTop a").scrollTop();'
);
?>





