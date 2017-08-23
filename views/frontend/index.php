<?php

use app\models\Image;
use traversient\yii\customscrollbar\AssetBundle;
use yii\helpers\Html;
use yii\helpers\Url;

AssetBundle::register($this);

$this->title = 'Mayer Hörmann';

$imageMdl = new Image();
$imageMdl -> type = 'startseite';
$rndTitleImage = $imageMdl -> getRndImages(1);
$imagePath = Url::to('/' . $rndTitleImage[0]->path . $rndTitleImage[0]->name);

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


    <div id="row">
        <div class="col-xs-12 col-sm-12 col-md-6 col-lg-4">
            <div class="card">
                <div class="cardImageContainer">
                    <?php echo Html::img($imagePath, ['alt'=>'weingarten', 'class'=>'cardImage']); ?>
                </div>
                <div class="cardHeadline">
                    <h1> Meine Aktuelles Ding und noch mehr Text</h1>
                </div>
                <div class="cardText">
                    <p>Lorem ipsum dolor sit amet, consetetur sadipscing elitr, sed diam nonumy eirmod tempor invidunt
                        ut labore et dolore magna aliquyam erat, sed diam voluptua. At vero eos et accusam et justo duo
                        dolores et ea rebum. Stet clita kasd gubergren, no sea takimata sanctus est Lorem ipsum dolor sit amet.
                        Lorem ipsum dolor sit amet, consetetur sadipscing elitr, sed diam nonumy eirmod tempor invidunt ut
                        labore et dolore magna aliquyam erat, sed diam voluptua. Lorem ipsum dolor sit amet, consetetur sadipscing elitr, sed diam nonumy eirmod tempor invidunt
                        ut labore et dolore magna aliquyam erat, sed diam voluptua. At vero eos et accusam et justo duo
                        dolores et ea rebum. Stet clita kasd gubergren, no sea takimata sanctus est Lorem ipsum dolor sit amet.
                        Lorem ipsum dolor sit amet, consetetur sadipscing elitr, sed diam nonumy eirmod tempor invidunt ut
                        labore et dolore magna aliquyam erat, sed diam voluptua. Lorem ipsum dolor sit amet, consetetur sadipscing elitr, sed diam nonumy eirmod tempor invidunt
                        ut labore et dolore magna aliquyam erat, sed diam voluptua. At vero eos et accusam et justo duo
                        dolores et ea rebum. Stet clita kasd gubergren, no sea takimata sanctus est Lorem ipsum dolor sit amet.
                        Lorem ipsum dolor sit amet, consetetur sadipscing elitr, sed diam nonumy eirmod tempor invidunt ut
                        labore et dolore magna aliquyam erat, sed diam voluptua. Lorem ipsum dolor sit amet, consetetur sadipscing elitr, sed diam nonumy eirmod tempor invidunt
                        ut labore et dolore magna aliquyam erat, sed diam voluptua. At vero eos et accusam et justo duo
                        dolores et ea rebum. Stet clita kasd gubergren, no sea takimata sanctus est Lorem ipsum dolor sit amet.
                        Lorem ipsum dolor sit amet, consetetur sadipscing elitr, sed diam nonumy eirmod tempor invidunt ut
                        labore et dolore magna aliquyam erat, sed diam voluptua.</p>
                </div>
            </div>
        </div>
        <div class="col-xs-12 col-sm-12 col-md-6 col-lg-4">
            <div class="card">
                <div class="cardImageContainer">
                    <?php echo Html::img($imagePath, ['alt'=>'weingarten', 'class'=>'cardImage']); ?>
                </div>

                <div class="cardHeadline">
                    <h1> Meine Aktuelles Ding</h1>
                </div>
                <div class="cardText">
                    <p>Lorem ipsum dolor sit amet, consetetur sadipscing elitr, sed diam nonumy eirmod tempor invidunt
                        ut labore et dolore magna aliquyam erat, sed diam voluptua. At vero eos et accusam et justo duo
                        dolores et ea rebum. Stet clita kasd gubergren, no sea takimata sanctus est Lorem ipsum dolor sit amet.
                        Lorem ipsum dolor sit amet, consetetur sadipscing elitr, sed diam nonumy eirmod tempor invidunt ut
                        labore et dolore magna aliquyam erat, sed diam voluptua. Lorem ipsum dolor sit amet, consetetur sadipscing elitr, sed diam nonumy eirmod tempor invidunt
                        ut labore et dolore magna aliquyam erat, sed diam voluptua. At vero eos et accusam et justo duo
                        dolores et ea rebum. Stet clita kasd gubergren, no sea takimata sanctus est Lorem ipsum dolor sit amet.
                        Lorem ipsum dolor sit amet, consetetur sadipscing elitr, sed diam nonumy eirmod tempor invidunt ut
                        labore et dolore magna aliquyam erat, sed diam voluptua.</p>
                </div>
            </div>
        </div>
        <div class="col-xs-12 col-sm-12 col-md-6 col-lg-4">
            <div class="card">
                <div class="cardImageContainer">
                    <?php echo Html::img($imagePath, ['alt'=>'weingarten', 'class'=>'cardImage']); ?>
                </div>

                <div class="cardHeadline">
                    <h1> Meine Aktuelles Ding</h1>
                </div>
                <div class="cardText">
                    <p>Lorem ipsum dolor sit amet, consetetur sadipscing elitr, sed diam nonumy eirmod tempor invidunt
                        ut labore et dolore magna aliquyam erat, sed diam voluptua. At vero eos et accusam et justo duo
                        dolores et ea rebum. Stet clita kasd gubergren. </p>
                </div>
            </div>
        </div>
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








