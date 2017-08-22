<?php
/**
 * Created by PhpStorm.
 * User: Christoph Rohrmoser
 * Date: 21.06.2017
 * Time: 12:38
 */

use yii\helpers\html;

?>

<footer class="footer">
    <!--    BEGIN desktop version footer-->
    <div id="footer" class="container hidden-xs">
        <div class="row">
            <!--    BEGIN footer column 1-->
            <div class="col-sm-6">
                <h4> Kontakt </h4>
                <p> <b> Inhaber: </b> Ingrid und Hans MAYER </p>
                <p> <b> Mobiltelefon: </b> 0043 664 1017056 </p>
                <p> <b> E-Mail: </b> <?= Html::mailto('mh@veltliner.at', 'mh@veltliner.at', ['id' => 'mailtoLinkFooter']) ?> </p>
                <p> <b> Weinkellerei: </b> 3492 Engabrunn, Kirchengasse 17 </p>
                <p> <b> Heuriger: </b> 3483 Feuersbrunn, Weinstraße 2 </p>
            </div>
            <!--    BEGIN footer column 2-->
            <div class="col-sm-3">
                <h4> Social Media </h4>
                <div id="footercol2Container1" class="footer3container">
                    <div id="icon_facebook" class="iconFooter"></div>
                    <div id="text_facebook" class="iconTextFooter">
                        <p> &nbsp; &nbsp; Facebook </p>
                    </div>
                </div>

                <div class="footer3container">
                    <div id="icon_instagram" class="iconFooter"></div>
                    <div id="text_instagram" class="iconTextFooter">
                        <p> &nbsp; &nbsp; Instagram </p>
                    </div>
                </div>

                <div class="footer3container">
                    <div id="icon_youtube" class="iconFooter"></div>
                    <div id="text_youtube" class="iconTextFooter">
                        <p> &nbsp; &nbsp; Youtube </p>
                    </div>
                </div>
            </div>
            <!--    BEGIN footer column 3-->
            <div class="col-sm-3">
                <h4> Sonstiges </h4>
                <div id="footercol3Container1">
                    <?= Html::a('Über uns', ['site/ueber-uns'], ['class' => 'linkFooter']) ?>
                </div>

                <?= Html::a('Newsletter-Anmeldung', ['site/newsletter-sign-up'], ['class' => 'linkFooter']) ?> <br>
                <?= Html::a('Impressum', ['site/impressum'], ['class' => 'linkFooter']) ?> <br>
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
                <li><a href="#sonstiges" data-toggle="tab">Sonstiges</a></li>
            </ul>
        </div>
        <div class="tab-content ">
            <!--    BEGIN footer column 1-->
            <div class="tab-pane active" id="kontakt">
                <p> <b> Inhaber: </b> Ingrid und Hans MAYER </p>
                <p> <b> Mobiltelefon: </b> 0043 664 1017056 </p>
                <p> <b> E-Mail: </b> <?= Html::mailto('mh@veltliner.at', 'mh@veltliner.at', ['id' => 'mailtoLinkFooter']) ?> </p>
                <p> <b> Weinkellerei: </b> 3492 Engabrunn, Kirchengasse 17 </p>
                <p> <b> Heuriger: </b> 3483 Feuersbrunn, Weinstraße 2 </p>
            </div>
            <!--    BEGIN footer column 2-->
            <div class="tab-pane" id="socialMedia">
                <div class="footer3container">
                    <div id="icon_facebook" class="iconFooter"></div>
                    <div id="text_facebook" class="iconTextFooter">
                        <p> &nbsp; &nbsp; Facebook </p>
                    </div>
                </div>

                <div class="footer3container">
                    <div id="icon_instagram" class="iconFooter"></div>
                    <div id="text_instagram" class="iconTextFooter">
                        <p> &nbsp; &nbsp; Instagram </p>
                    </div>
                </div>

                <div class="footer3container">
                    <div id="icon_youtube" class="iconFooter"></div>
                    <div id="text_youtube" class="iconTextFooter">
                        <p> &nbsp; &nbsp; Youtube </p>
                    </div>
                </div>
            </div>
            <!--    BEGIN footer column 3-->
            <div class="tab-pane" id="sonstiges">
                <?= Html::a('Über uns', ['site/ueber-uns'], ['class' => 'linkFooter']) ?> <br>
                <?= Html::a('Newsletter-Anmeldung', ['site/newsletter-sign-up'], ['class' => 'linkFooter']) ?> <br>
                <?= Html::a('Impressum', ['site/impressum'], ['class' => 'linkFooter']) ?> <br>
            </div>
        </div>
    </div>
</footer>