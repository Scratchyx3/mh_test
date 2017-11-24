<?php
/**
 * Created by PhpStorm.
 * User: Christoph Rohrmoser
 * Date: 27.06.2017
 * Time: 11:24
 */

use app\models\Image\ImageFactory;
use yii\helpers\Url;

$imageMdl = ImageFactory::create('titleImage', 'impressum');
$image = $imageMdl -> getRandomImage();
$imagePath = Url::to('/' . $image[0]['path'] . $image[0]['name']);

?>
<div class="container-fluid">
    <div class="row">
        <div class="standardTitleImageContainer" style='background-image: url(<?= $imagePath ?>);'></div>
    </div>
</div>

<div class="container">
    <div class="row">
        <div class="col-xs-0 col-sm-0 col-md-2 col-lg-2"> </div>
        <div class="col-xs-12 col-sm-12 col-md-8 col-lg-8">
            <div id="textContentImpressum" class="textContent">
                <h1> Impressum </h1>

                <p> Informationspflicht laut &sect;5 E-Commerce Gesetz, &sect;14 Unternehmensgesetzbuch,
                    &sect;63 Gewerbeordnung und Offenlegungspflicht laut &sect;25 Mediengesetz
                </p>
                <br>
                <p>Mayer-H&ouml;rmann
                    <br />
                    Ingrid&nbsp;Mayer
                    <br />
                    Hauptstra&szlig;e, 42&nbsp;Stiege 1 T&uuml;r 1
                    <br />
                    A-3492&nbsp;Engabrunn
                    <br />
                    &Ouml;sterreich
                </p>
                <br>
                <p><strong><span style="border:none windowtext 1.0pt; padding:0cm">Unternehmensgegenstand:</span></strong>&nbsp;Winzerhof &amp; Heuriger
                </p>
                <p><strong><span style="border:none windowtext 1.0pt; padding:0cm">Tel.:</span></strong>&nbsp;0043 6641017056
                    <br />
                    <strong><span style="border:none windowtext 1.0pt; padding:0cm">Fax:</span></strong>&nbsp;0043 27355134
                    <br />
                    <strong><span style="border:none windowtext 1.0pt; padding:0cm">E-Mail:</span></strong>&nbsp;<a href="mailto:mh@veltliner.at"><span style="border:none windowtext 1.0pt; padding:0cm">mh@veltliner.at</span></a>
                </p>
                <p><strong><span style="border:none windowtext 1.0pt; padding:0cm">UID-Nummer:</span></strong>&nbsp;ATU47669401
                </p>
                <p><strong><span style="border:none windowtext 1.0pt; padding:0cm">Mitglied bei:</span></strong>&nbsp;Landwirtschaftskammer
                    <br />
                    <strong><span style="border:none windowtext 1.0pt; padding:0cm">Berufsrecht:</span></strong>&nbsp;Gewerbeordnung: Land- und Forstwirtschaft
                </p>
                <p><strong><span style="border:none windowtext 1.0pt; padding:0cm">Aufsichtsbeh&ouml;rde/Gewerbebeh&ouml;rde:</span></strong>&nbsp;Bezirkshauptmannschaft Krems
                    <br />
                    <strong><span style="border:none windowtext 1.0pt; padding:0cm">Berufsbezeichnung:</span></strong>&nbsp;Wein und Kellerbaumeister
                    <br />
                    <strong><span style="border:none windowtext 1.0pt; padding:0cm">Verleihungsstaat:</span></strong>&nbsp;&Ouml;sterreich
                </p>
                <br>
                <p>Angaben zur Online-Streitbeilegung: Verbraucher haben die M&ouml;glichkeit, Beschwerden an die Online-Streitbeilegungsplattform der EU zu richten:&nbsp;<a href="https://webgate.ec.europa.eu/odr/main/index.cfm?event=main.home.show&amp;lng=DE" target="_blank"><span style="border:none windowtext 1.0pt; padding:0cm">http://ec.europa.eu/odr</span></a>. Sie k&ouml;nnen allf&auml;llige Beschwerde auch an die oben angegebene E-Mail-Adresse richten.
                </p>
                <p>Quelle: Impressum mit dem&nbsp;<a href="http://www.aboutbusiness.at/impressum-generator" target="_blank"><span style="border:none windowtext 1.0pt; padding:0cm">Impressum Generator von aboutbusiness.at</span></a>&nbsp;erstellt in Kooperation mit&nbsp;<a href="http://www.servussalzburg.at/" target="_blank"><span style="border:none windowtext 1.0pt; padding:0cm; text-decoration:none; text-underline:none">servussalzburg.at</span></a>.
                </p>
                <p>&nbsp;
                </p>
                <h2>Datenschutzerkl&auml;rung</h2>
                <p>Wir legen gro&szlig;en Wert auf den Schutz Ihrer Daten. Um Sie in vollem Umfang &uuml;ber die Verwendung personenbezogener Daten zu informieren, bitten wir Sie die folgenden Datenschutzhinweise zur Kenntnis zu nehmen.
                </p>
                <h4>Pers&ouml;nliche Daten</h4>
                <p>Pers&ouml;nliche Daten, die Sie auf dieser&nbsp;Website elektronisch &uuml;bermitteln, wie zum Beispiel Name, E-Mail-Adresse, Adresse&nbsp;oder andere pers&ouml;nlichen Angaben, werden von uns nur zum jeweils angegebenen Zweck verwendet, sicher verwahrt und nicht an Dritte weitergegeben. Der Provider erhebt und speichert automatisch Informationen am Webserver wie verwendeter Browser, Betriebssystem, Verweisseite, IP-Adresse, Uhrzeit des Zugriffs usw. Diese Daten k&ouml;nnen ohne Pr&uuml;fung weiterer Datenquellen keinen bestimmten Personen zugeordnet werden und wir werten diese Daten auch nicht weiter aus solange keine rechtswidrige Nutzung unserer Webseite vorliegt.
                </p>
                <h4>Google Maps</h4>
                <p>Diese Webseite verwendet Google Maps f&uuml;r die Darstellung von Karteninformationen. Bei der Nutzung von Google Maps werden von Google auch Daten &uuml;ber die Nutzung der Maps-Funktionen durch Besucher der Webseiten erhoben, verarbeitet und genutzt. N&auml;here Informationen &uuml;ber die Datenverarbeitung durch Google k&ouml;nnen Sie den Datenschutzhinweisen von Google auf&nbsp;<a href="https://www.google.at/intl/de/policies/privacy/" target="_blank"><span style="border:none windowtext 1.0pt; padding:0">www.google.at/intl/de/policies/privacy</span></a>&nbsp;&nbsp;entnehmen. Dort k&ouml;nnen Sie im Datenschutzcenter auch Ihre Einstellungen ver&auml;ndern, so dass Sie Ihre Daten verwalten und sch&uuml;tzen k&ouml;nnen.
                </p>
                <p>&nbsp;
                </p>
                <h2>Auskunftsrecht</h2>
                <p>Sie haben jederzeit das Recht auf Auskunft &uuml;ber die bez&uuml;glich Ihrer Person gespeicherten Daten, deren Herkunft und Empf&auml;nger sowie den Zweck der Speicherung.
                </p>
            </div>
        </div>
        <div class="col-xs-0 col-sm-0 col-md-2 col-lg-2"> </div>
    </div>
</div>