<?php
/**
 * Created by PhpStorm.
 * User: Christoph Rohrmoser
 * Date: 07.12.2017
 * Time: 10:25
 */

use app\models\OpeningHour;
use dosamigos\google\maps\LatLng;
use dosamigos\google\maps\Map;
use dosamigos\google\maps\overlays\Marker;

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
    'title' => 'Wince Cellar',
]);

// add marker to the map
$map->addOverlay($marker);

// add a marker
$marker = new Marker([
    'position' => $cordHeuriger,
    'title' => 'Wine Tavern',
]);

// add marker to the map
$map->addOverlay($marker);

// Display the map
echo $map->display();

// ============== opening hours ====================
$events = OpeningHour::find()->where(['event' => 1])->orderBy('from_date')->all();
$openingHours = OpeningHour::find()->where(['event' => 0])->orderBy('from_date')->all();

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

