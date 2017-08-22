<?php
/**
 * Created by PhpStorm.
 * User: Christoph Rohrmoser
 * Date: 21.06.2017
 * Time: 13:27
 */

use dosamigos\google\maps\LatLng;
use dosamigos\google\maps\Map;
use dosamigos\google\maps\overlays\InfoWindow;
use dosamigos\google\maps\overlays\Marker;

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
?>
