<?php

use app\models\Card;
use app\models\Image\ImageFactory;
use traversient\yii\customscrollbar\AssetBundle;
use yii\helpers\Html;
use yii\helpers\Url;

AssetBundle::register($this);

$this->title = 'Mayer Hörmann';

$imageMdl = ImageFactory::create('titleImage', 'startseite');
$image = $imageMdl -> getRandomImage();
$imagePath = Url::to('/' . $image[0]['path'] . $image[0]['name']);


$cardMdl = new Card();
$cardMdlArray = $cardMdl->find()->where(['imageType' => 'card_startseite'])->orderBy(['id'=>SORT_DESC])->all();
$imageMdl = ImageFactory::create('cardImage', 'card_startseite');

?>
<div id="iconDownContainer">
    <a href="#headlineAktuelles">
        <div class="iconDown">

        </div>
    </a>
</div>

<div class="container-fluid">
    <div class="row">
        <div class="indexTitleImageContainer" style='background-image: url(<?= $imagePath ?>);'></div>
    </div>
    <div id="row">
        <div id="headlineAktuelles" class="row headline">
            <h1> Aktuelles </h1>
        </div>
    </div>
</div>
<div class="container">
    <div id="row">
        <?php
        foreach($cardMdlArray as $cardMdl) {
            $imageMdl = $imageMdl->findOne($cardMdl->fkImage);
            echo "<div class='col-xs-12 col-sm-12 col-md-6 col-lg-6'>";
                echo "<div class='card'>";
                    if(isset($cardMdl->instagramLink) && !empty($cardMdl->instagramLink)) {
                        echo "<a class='disableLink' target='_blank' href='" . $cardMdl->instagramLink . "'>";
                        echo "<div class='cardImageContainer'>";
                        echo Html::img(Url::to('/' . $imageMdl->path . $imageMdl->name), ['alt'=>'weingarten', 'class'=>'cardImage']);
                        echo "</div>";
                        echo "</a>";
                    } else {
                        echo "<div class='cardImageContainer'>";
                        echo Html::img(Url::to('/' . $imageMdl->path . $imageMdl->name), ['alt'=>'weingarten', 'class'=>'cardImage']);
                        echo "</div>";
                    }
                    echo "<div class='cardHeadline'>";
                        echo "<h1>" . $cardMdl->headline . "</h1>";
                    echo "</div>";
                    echo "<div class='cardText'>";
                        echo $cardMdl->content;
                    echo "</div>";
                echo "</div>";
            echo "</div>";
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
'$("#iconDownContainer a").click(function(){
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





