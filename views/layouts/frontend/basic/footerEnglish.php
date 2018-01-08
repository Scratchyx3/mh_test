<?php
/**
 * Created by PhpStorm.
 * User: Christoph Rohrmoser
 * Date: 16.11.2017
 * Time: 13:20
 */

use app\models\OpeningHour;
use yii\helpers\html;

$events = OpeningHour::find()->where(['event' => 1])->orderBy('from_date')->all();
$openingHours = OpeningHour::find()->where(['event' => 0])->orderBy('from_date')->all();
Yii::$app->formatter->locale = 'en-US';

?>

<footer class="footer">
    <!--    BEGIN desktop version footer-->
    <div id="footer" class="container hidden-xs">
        <div class="row">
            <!--    BEGIN footer column 1-->
            <div class="col-sm-6">
                <h4> Contact Us </h4>
                <p> <b> Owner: </b> Ingrid and Hans MAYER </p>
                <p> <b> Mobile Phone: </b> 0043 664 1017056 </p>
                <p> <b> E-Mail: </b> <?= Html::mailto('mh@veltliner.at', 'mh@veltliner.at', ['id' => 'mailtoLinkFooter']) ?> </p>
                <p> <b> Wine Cellar: </b> 3492 Engabrunn, Kirchengasse 17 </p>
                <p> <b> Wine Tavern: </b> 3483 Feuersbrunn, Weinstraße 2 </p>
            </div>
            <!--    BEGIN footer column 2-->
            <div class="col-sm-3">
                <h4> Social Media </h4>
                <div id="footercol2Container1" class="footer3container">
                    <a href="https://www.facebook.com/Veltliner" target="_blank">
                        <div id="icon_facebook" class="iconFooter"></div>
                        <div id="text_facebook" class="iconTextFooter">
                            <p> &nbsp; &nbsp; Facebook </p>
                        </div>
                    </a>
                </div>

                <div class="footer3container">
                    <a class="linkSocialMedia" href="https://www.instagram.com/veltliner.at" target="_blank">
                        <div id="icon_instagram" class="iconFooter"></div>
                        <div id="text_instagram" class="iconTextFooter">
                            <p> &nbsp; &nbsp; Instagram </p>
                        </div>
                    </a>
                </div>

                <div class="footer3container">
                    <a class="linkSocialMedia" href="https://www.youtube.com/user/Hansi64m" target="_blank">
                        <div id="icon_youtube" class="iconFooter"></div>
                        <div id="text_youtube" class="iconTextFooter">
                            <p> &nbsp; &nbsp; Youtube </p>
                        </div>
                    </a>
                </div>
            </div>
            <div id="openingHoursEnglish" class="col-sm-3">
                <h4> Opening Hours </h4>
                <?php
                foreach ($openingHours as $openingHour) {
                    $f = Yii::$app->formatter;
                    $d = $f->asOrdinal($f->asDate($openingHour->from_date, 'php:j'));
                    $d2 = $f->asOrdinal($f->asDate($openingHour->to_date, 'php:j'));

                    echo "<p>" .
                        $d .
                        Yii::$app->formatter->asDate($openingHour->from_date, 'php: M Y') .
                        " - " .
                        $d2 .
                        Yii::$app->formatter->asDate($openingHour->to_date, 'php: M Y') .
                        "</p>";
                }

                foreach ($events as $event) {
                    $f = Yii::$app->formatter;
                    $d = $f->asOrdinal($f->asDate($event->from_date, 'php:j'));
                    $d2 = $f->asOrdinal($f->asDate($event->to_date, 'php:j'));


                    echo "<p><b>" .
                        $event->event_name . "</b>: " .
                        $d .
                        Yii::$app->formatter->asDate($event->from_date, 'php: M Y') .
                        " - " .
                        $d2 .
                        Yii::$app->formatter->asDate($event->to_date, 'php: M Y') .
                        "</p>";
                }
                ?>
            </div>
        </div>
    </div>
    <!--    BEGIN mobile version footer-->
    <div id="footerMobile" class="container-fluid visible-xs">
        <div class="row">
            <ul id="nav-tabs" class="nav nav-tabs">
                <!--    tab 1-->
                <li class="active"><a id="linkKontakt" href="#kontakt" data-toggle="tab">Kontakt</a></li>
                <!--    tab 2-->
                <li><a href="#socialMedia" data-toggle="tab">Social Media</a></li>
                <!--    tab 3-->
                <li><a href="#openingHours" data-toggle="tab">Opening Hours</a></li>
            </ul>
        </div>
        <div class="tab-content ">
            <!--    BEGIN footer column 1-->
            <div class="tab-pane active" id="kontakt">
                <p> <b> Owner: </b> Ingrid and Hans MAYER </p>
                <p> <b> Mobile Phone: </b> 0043 664 1017056 </p>
                <p> <b> E-Mail: </b> <?= Html::mailto('mh@veltliner.at', 'mh@veltliner.at', ['id' => 'mailtoLinkFooter']) ?> </p>
                <p> <b> Wine Cellar: </b> 3492 Engabrunn, Kirchengasse 17 </p>
                <p> <b> Wine Tavern: </b> 3483 Feuersbrunn, Weinstraße 2 </p>
            </div>
            <!--    BEGIN footer column 2-->
            <div class="tab-pane" id="socialMedia">
                <div class="footer3container">
                    <a href="https://www.facebook.com/Veltliner" target="_blank">
                        <div id="icon_facebook" class="iconFooter"></div>
                        <div id="text_facebook" class="iconTextFooter">
                            <p> &nbsp; &nbsp; Facebook </p>
                        </div>
                    </a>
                </div>

                <div class="footer3container">
                    <a class="linkSocialMedia" href="https://www.instagram.com/veltliner.at" target="_blank">
                        <div id="icon_instagram" class="iconFooter"></div>
                        <div id="text_instagram" class="iconTextFooter">
                            <p> &nbsp; &nbsp; Instagram </p>
                        </div>
                    </a>
                </div>
                <div class="footer3container">
                    <a class="linkSocialMedia" href="https://www.youtube.com/user/Hansi64m" target="_blank">
                        <div id="icon_youtube" class="iconFooter"></div>
                        <div id="text_youtube" class="iconTextFooter">
                            <p> &nbsp; &nbsp; Youtube </p>
                        </div>
                    </a>
                </div>
            </div>
            <!--    BEGIN footer column 3-->
            <div class="tab-pane" id="openingHours">
                <?php
                foreach ($openingHours as $openingHour) {
                    $f = Yii::$app->formatter;
                    $d = $f->asOrdinal($f->asDate($openingHour->from_date, 'php:j'));
                    $d2 = $f->asOrdinal($f->asDate($openingHour->to_date, 'php:j'));

                    echo "<p>" .
                        $d .
                        Yii::$app->formatter->asDate($openingHour->from_date, 'php: M Y') .
                        " - " .
                        $d2 .
                        Yii::$app->formatter->asDate($openingHour->to_date, 'php: M Y') .
                        "</p>";
                }

                foreach ($events as $event) {
                    $f = Yii::$app->formatter;
                    $d = $f->asOrdinal($f->asDate($event->from_date, 'php:j'));
                    $d2 = $f->asOrdinal($f->asDate($event->to_date, 'php:j'));


                    echo "<p><b>" .
                        $event->event_name . "</b>: " .
                        $d .
                        Yii::$app->formatter->asDate($event->from_date, 'php: M Y') .
                        " - " .
                        $d2 .
                        Yii::$app->formatter->asDate($event->to_date, 'php: M Y') .
                        "</p>";
                }
                ?>
            </div>
        </div>
    </div>
</footer>