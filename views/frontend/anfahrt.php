<?php
/**
 * Created by PhpStorm.
 * User: Christoph Rohrmoser
 * Date: 21.06.2017
 * Time: 13:27
 */

use app\models\OpeningHour;
use dosamigos\google\maps\LatLng;
use dosamigos\google\maps\Map;
use dosamigos\google\maps\overlays\InfoWindow;
use dosamigos\google\maps\overlays\Marker;
use yii\helpers\Html;
use yii\helpers\Url;

?>

<a id="linkIconDown" href="#footerAnchor">
    <div class="iconDown"> </div>
</a>

<?php

// setting map center coordinate
$coord = new LatLng(['lat' => 48.4553417, 'lng' => 15.7639217]);
$map = new Map([
    'center' => $coord,
    'zoom' => 13,
    'mapTypeId' => 'roadmap',
]);
// setting marker coordinates
$cordWeinkeller = new LatLng(['lat' => 48.4487262, 'lng' => 15.7587849]);
$cordHeuriger = new LatLng(['lat' => 48.4439198, 'lng' => 15.7950406]);

// add a marker
$marker = new Marker([
    'position' => $cordWeinkeller,
    'title' => 'Weinkeller',
]);
// Provide a shared InfoWindow to the marker
$marker->attachInfoWindow(
    new InfoWindow([
        'content' => '<p>This is my super cool content UND SO WEITER</p>',
    ])
);

// add marker to the map
$map->addOverlay($marker);

// add a marker now
$marker = new Marker([
    'position' => $cordHeuriger,
    'title' => 'Heuriger',
]);

// add marker to the map
$map->addOverlay($marker);

// Display the map
echo $map->display();

// ============== opening hours ====================
$events = OpeningHour::find()->where(['event' => 1])->orderBy('from_date')->all();
$openingHours = OpeningHour::find()->where(['event' => 0])->orderBy('from_date')->all();
?>

<!-- Footer with opening hours -->
<footer id="footerAnchor" class="footer">
    <!--    BEGIN desktop version footer-->
    <div id="footerAnfahrt" class="container hidden-xs">
        <div class="row">
            <!--    BEGIN footer column 1-->
            <div class="col-sm-6">
                <h4> Öffnungszeiten Heuriger </h4>
                <?php

                foreach ($openingHours as $openingHour) {
                    echo "<p>" .
                        Yii::$app->formatter->asDate($openingHour->from_date, 'php: d. M Y') .
                        " - " .
                        Yii::$app->formatter->asDate($openingHour->to_date, 'php: d. M Y') .
                        "</p>";
                }

                foreach ($events as $event) {
                    echo "<p><b>" .
                        $event->event_name . "</b>: " .
                        Yii::$app->formatter->asDate($event->from_date, 'php: d. M Y') .
                        " - " .
                        Yii::$app->formatter->asDate($event->to_date, 'php: d. M Y') .
                        "</p>";
                }
                ?>
                <p>(täglich ab 15:00 Uhr geöffnet)</p>
            </div>
            <!--    BEGIN footer column 2-->
            <div class="col-sm-6">
                <h4> Weinverkauf  </h4>
                <p> Weinverkauf und Besichtigung ganzjährig gegen Voranmeldung. </p>
                <p> <b> Mobiltelefon: </b> 0043 664 1017056 </p>
                <p> <b> E-Mail: </b> <?= Html::mailto('mh@veltliner.at', 'mh@veltliner.at', ['id' => 'mailtoLinkFooter']) ?> </p>
                <p> <b> Weinkarte: </b> <?= Html::a('Unsere Weinkarte', Url::to(['file_upload/weinkarte/weinkarte.pdf']), ['class' => 'linkFooter', 'target' => '_blank']) ?> </p>
            </div>

        </div>
    </div>
<!--    BEGIN mobile version footer-->
<div id="footerAnfahrtMobile" class="container-fluid visible-xs footerMobile">
    <div class="row">
        <ul id="nav-tabs" class="nav nav-tabs">
            <!--    tab 1-->
            <li class="active"><a id="linkKontakt" href="#kontakt" data-toggle="tab">Öffnungszeiten Heuriger</a></li>
            <!--    tab 2-->
            <li><a href="#socialMedia" data-toggle="tab">Weinverkauf</a></li>
        </ul>
    </div>
    <div class="tab-content ">
        <!--    BEGIN footer column 1-->
        <div class="tab-pane active" id="kontakt">
            <?php
            foreach ($openingHours as $openingHour) {
                echo "<p>" .
                    Yii::$app->formatter->asDate($openingHour->from_date, 'php: d. M Y') .
                    " - " .
                    Yii::$app->formatter->asDate($openingHour->to_date, 'php: d. M Y') .
                    "</p>";
            }

            foreach ($events as $event) {
                echo "<p><b>" .
                    $event->event_name . "</b>: " .
                    Yii::$app->formatter->asDate($event->from_date, 'php: d. M Y') .
                    " - " .
                    Yii::$app->formatter->asDate($event->to_date, 'php: d. M Y') .
                    "</p>";
            }
            ?>
            <p>(täglich ab 15:00 Uhr geöffnet)</p>
        </div>
        <!--    BEGIN footer column 2-->
        <div class="tab-pane" id="socialMedia">
            <p> Weinverkauf und Besichtigung ganzjährig gegen Voranmeldung. </p>
            <p> <b> Mobiltelefon: </b> 0043 664 1017056 </p>
            <p> <b> E-Mail: </b> <?= Html::mailto('mh@veltliner.at', 'mh@veltliner.at', ['id' => 'mailtoLinkFooter']) ?> </p>
            <p> <b> Weinkarte: </b> <?= Html::a('Unsere Weinkarte', Url::to(['file_upload/weinkarte/weinkarte.pdf']), ['class' => 'linkFooter', 'target' => '_blank']) ?> </p>
        </div>
    </div>
</div>
</footer>

<?php
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

