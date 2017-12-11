<?php
/**
 * Created by PhpStorm.
 * User: Christoph Rohrmoser
 * Date: 16.11.2017
 * Time: 13:13
 */

use app\models\OpeningHour;

// ============== opening hours ====================
$events = OpeningHour::find()->where(['event' => 1])->orderBy('from_date')->all();
$openingHours = OpeningHour::find()->where(['event' => 0])->orderBy('from_date')->all();
Yii::$app->formatter->locale = 'en-US';
?>

<div class="container">
    <div class="row">
        <div class="col-xs-0 col-sm-0 col-md-2 col-lg-2"> </div>
        <div class="col-xs-12 col-sm-12 col-md-8 col-lg-8">
            <div id="openHoursEnglish" class="openingHours">
                <h1> Our Wine Tavern Opening Hours </h1>
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
                <p>(daily, starting at 3pm)</p>
            </div>
        </div>
        <div class="col-xs-0 col-sm-0 col-md-2 col-lg-2"> </div>
    </div>

    <div class="row">
        <div class="col-xs-0 col-sm-0 col-md-2 col-lg-2"></div>
        <div class="col-xs-12 col-sm-12 col-md-8 col-lg-8">
            <div id="textContentEnglish" class="textContent">
                <h1> Taste Mayer-Hoermann's wines </h1>
                <p>Nature gives the fruit. We refine the product. The wine estate Mayer-Hörmann is located south-east of
                    the winegrowing area Kamptal. “Producing Grüner Veltliner is the most exciting thing a vintner can
                    do” is our belief. The styles of wines range from light and fruity to complex and powerful. In
                    addition, many other varities are planted, e.g. Welschriesling, Riesling, Gelber Muskateller,
                    Gemischter Satz, Chardonnay, Sauvignon blanc, different red vins such as Zweigelt, Shiraz, St.
                    Laurent, Blauburger, and the new Zweigelt Barrique , with its oaky note.
                    The vintners` pride and joy: </p>

                <h1> The vintners` pride and joy: </h1>
                <ul>
                    <li>12 x Gold NÖ-Landesweinmesse</li>
                    <li>Top-Heurigensieger vom Wagram</li>
                </ul>

                <div class="col-xs-12 col-sm-12 col-md-6 col-lg-6 colEnglish1">
                    <div id="imageEnglishPride1" class="imageContainerEnglish"> </div>
                </div>

                <div class="col-xs-0 col-sm-6 col-md-6 col-lg-6 hidden-xs hidden-sm colEnglish2">
                    <div id="imageEnglishPride2" class="imageContainerEnglish"> </div>
                </div>


                <p>This wine tavern should be a meeting place for all who enjoy good food, good wines and life in
                    general. Guests are invited to spend the whole afternoon in the great garden or the nice tavern
                    inside, just for relaxing. The team in the kitchen tries to produce dishes from regional products
                    from the season. The homemade bacon and cakes are a must for every guest. Visitors have the chance
                    to taste each wine from the estate in a cheerful and lively atmosphere.</p><br/>
                <p><b>Ex cellar door in Engabrunn at any time, please call ahead.</b></p>
                <h1>Land and culture</h1>
                <p>The Mayer- Hörmann estate cultivates its vineyards in the wine growing area of Kamptal and Wagram.
                    Warm, sunny summers and long, mild autumn days with cool nights are characteristic for these
                    regions. The estate is fortunate to have vineyards with varying kinds of soil. Some vins especially
                    the Grüner Veltliner like deep loess soil, others prefer primary rock and gravel. The microclimate is
                    defined by a great change in temperature between day and night. Wine growing is very labour
                    intensive. Ingrid and Hans Mayer spend much of their time in the vineyard and pay much attention to
                    canopy and soil management. The estate cultivates ten hectares of vineyards. Our top location This
                    single vineyard called Spiegel is situated on a gentle south-east facing slope with maximum exposure
                    to the sun. It is one of the most famous and significant vineyards of the region Kamptal. The soil
                    of this special vineyard is a result of the dry cold climate of the Ice Age. Several metres of loess
                    cover primary rock. Grapes from “Spiegel” always bring peppery Grüne Veltliner, typical for the
                    variety and the region. </p>
                <div class="col-xs-12 col-sm-12 col-md-6 col-lg-6 colEnglish1">
                    <div class="imageContainerEnglish"> </div>
                </div>

                <div class="col-xs-0 col-sm-6 col-md-6 col-lg-6 hidden-xs hidden-sm colEnglish2">
                    <div class="imageContainerEnglish"> </div>
                </div>
                <h1>Production</h1>
                <p>The first priority with freshly gathered white grapes( handpicked or harvested by machines) is to get
                    them to the press as soon as possible. At the winery the grapes go through a machine called a
                    crusher-destalker. It breaks the skin of the grapes but doesn`t press them, and removes all stalks.
                    The resulting mush is immediately poured into the press. All wines are fermented at 20 degrees
                    Celsius using natural and specific yeasts. Estate Mayer-Hörmann uses stainless steel tanks. They
                    keep the white wines` spicy flavours and freshness. Red wines are stored in barrels, some specials
                    like Zweigelt Barrique 2011 in smaller oak barrels, the barriques. Wines are bottled and closed with
                    a screwcap, labeled and ready for selling ex cellar door or by delivery. The focus of production
                    lies on bringing unique wines with plenty of finesse. </p> <br/>
                <p>Grüner Veltliner Kamptal DAC It is an easy drinking Grüner Veltliner, fruity and spicy with lively
                    acidity and elegant fruit. It has a peppery character and is a wine for every occasion. It offers
                    plenty of drinking pleasure.
                    Zweigelt Barriqueis stored in barriques and so it gets its oaky nose. It is a powerful, full bodied
                    red wine. Flavour reminds of dried plums, cinnamon and vanilla. This wine is well balanced and has
                    an individual taste. Very subtle! </p>
                <div class="col-xs-12 col-sm-12 col-md-6 col-lg-6 colEnglish1">
                    <div class="imageContainerEnglish"> </div>
                </div>

                <div class="col-xs-0 col-sm-6 col-md-6 col-lg-6 hidden-xs hidden-sm colEnglish2">
                    <div class="imageContainerEnglish"> </div>
                </div>
                <h1>The owners</h1>
               <h2>Ingrid Mayer</h2>
                <p>She runs the estate and the wine tavern with considerable passion and dedication. She graduated from
                    high school and then passed the professional master for winemaking.
                    She feels responsible for the welfare of the whole family. The two sons Matthias and Felix are still
                    students. She is also involved in sales and office work and runs the daily ex cellar door. </p>
                <h2>Hans Mayer</h2>
                <p>He began his career as a computer specialist and then changed to the business of winemaking.
                    He graduated from high school and taught himself the basic knowledge of wine making and enology. He
                    specialiced in vinification and marketing.
                    When you look for him you are most likely to find him in his winecellar. Only the daily control of
                    the wines guarantees high qualities. He always aims at producing unique and subtle wines and has
                    come to the conclusion: Each vintage is a challenge!</p>
                <div class="col-xs-12 col-sm-12 col-md-6 col-lg-6 colEnglish1">
                    <div class="imageContainerEnglish"> </div>
                </div>

                <div class="col-xs-0 col-sm-6 col-md-6 col-lg-6 hidden-xs hidden-sm colEnglish2">
                    <div class="imageContainerEnglish"> </div>
                </div>
            </div>
        </div>
        <div class="col-xs-0 col-sm-0 col-md-2 col-lg-2"></div>
    </div>
</div>
