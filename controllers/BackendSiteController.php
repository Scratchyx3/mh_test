<?php
/**
 * Created by PhpStorm.
 * User: Christoph Rohrmoser
 * Date: 12.08.2017
 * Time: 12:15
 */

namespace app\controllers;

use app\models\Card;
use app\models\OpeningHour;
use app\models\User;
use yii;
use yii\web\Controller;

class BackendSiteController extends Controller
{
    /**
     * Displays backendStartseite.php
     *
     * @return string
     */
    public function actionBackendLandingpage()
    {
        if (!Yii::$app->user->isGuest) {
            $this->layout='/backend/standard';
            return $this->render('/backend/backendLandingPage');
        } else {
            // if user is not logged in
            $model = new User();
            $this->layout='/backend/login';
            return $this->render('/backend/login', [
                'model' => $model,
            ]);
        }
    }
    /**
     * Displays backendStartseite.php
     *
     * @return string
     */
    public function actionBackendStartseite()
    {
        if (!Yii::$app->user->isGuest) {
            $cardMdl = new Card();
            $this->layout='/backend/standard';
            return $this->render('/backend/backendStartseite', [
            'model' => $cardMdl,
            ]);
        } else {
            // if user is not logged in
            $model = new User();
            $this->layout='/backend/login';
            return $this->render('/backend/login', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Displays backendOpeningHours.php
     *
     * @return string
     */
    public function actionBackendOpeningHours()
    {
        if (!Yii::$app->user->isGuest) {
            $ppeningHourMdl = new OpeningHour();
            $this->layout='/backend/standard';
            return $this->render('/backend/backendOpeningHours', [
                'model' => $ppeningHourMdl,
            ]);
        } else {
            // if user is not logged in
            $model = new User();
            $this->layout='/backend/login';
            return $this->render('/backend/login', [
                'model' => $model,
            ]);
        }
    }

    public function actionBackendStartseiteEdit($model)
    {
        if (!Yii::$app->user->isGuest) {
            $cardMdl = $model;
            $this->layout='/backend/standard';
            return $this->render('/backend/backendStartseite', [
                'model' => $cardMdl,
            ]);
        } else {
            // if user is not logged in
            $model = new User();
            $this->layout='/backend/login';
            return $this->render('/backend/login', [
                'model' => $model,
            ]);
        }
    }

    public function actionBackendEdit($site, $model)
    {
        if (!Yii::$app->user->isGuest) {
            $view = '/backend/backend' . $site;
            $cardMdl = $model;
            $this->layout='/backend/standard';
            return $this->render($view, [
                'model' => $cardMdl,
            ]);
        } else {
            // if user is not logged in
            $model = new User();
            $this->layout='/backend/login';
            return $this->render('/backend/login', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Displays backendHeuriger.php
     *
     * @return string
     */
    public function actionBackendHeuriger()
    {
        if (!Yii::$app->user->isGuest) {
            if(!$cardMdl = Card::find()->where(['imageType' => 'card_heuriger'])->one()) {
                $cardMdl = new Card();
            }
            $this->layout = '/backend/standard';
            return $this->render('/backend/backendHeuriger', [
                'model' => $cardMdl,
            ]);
        } else {
            // if user is not logged in
            $model = new User();
            $this->layout='/backend/login';
            return $this->render('/backend/login', [
                'model' => $model,
            ]);
        }
    }
    /**
     * Displays backendWeinkeller.php
     *
     * @return string
     */
    public function actionBackendWeinkeller()
    {
        if (!Yii::$app->user->isGuest) {
            if(!$cardMdl = Card::find()->where(['imageType' => 'card_weinkeller'])->one()) {
                $cardMdl = new card();
            }
            $this->layout = '/backend/standard';
            return $this->render('/backend/backendWeinkeller', [
                'model' => $cardMdl,
            ]);
        } else {
            // if user is not logged in
            $model = new User();
            $this->layout='/backend/login';
            return $this->render('/backend/login', [
                'model' => $model,
            ]);
        }
    }
    /**
     * Displays backendWeinkarte.php
     *
     * @return string
     */
    public function actionBackendWeinkarte()
    {
        if (!Yii::$app->user->isGuest) {
            $this->layout = '/backend/standard';
            return $this->render('/backend/backendWeinkarte');
        } else {
            // if user is not logged in
            $model = new User();
            $this->layout='/backend/login';
            return $this->render('/backend/login', [
                'model' => $model,
            ]);
        }
    }
    /**
     * Displays backendLagen.php
     *
     * @return string
     */
    public function actionBackendLagen()
    {
        if (!Yii::$app->user->isGuest) {
            $cardMdl = new Card();
            $this->layout = '/backend/standard';
            return $this->render('/backend/backendLagen', [
                'model' => $cardMdl,
            ]);
        } else {
            // if user is not logged in
            $model = new User();
            $this->layout='/backend/login';
            return $this->render('/backend/login', [
                'model' => $model,
            ]);
        }
    }
    /**
     * Displays backendAuszeichnungen.php
     *
     * @return string
     */
    public function actionBackendAuszeichnungen()
    {
        if (!Yii::$app->user->isGuest) {
            $cardMdl = new Card();
            $this->layout = '/backend/standard';
            return $this->render('/backend/backendAuszeichnungen', [
                'model' => $cardMdl,
            ]);
        } else {
            // if user is not logged in
            $model = new User();
            $this->layout='/backend/login';
            return $this->render('/backend/login', [
                'model' => $model,
            ]);
        }
    }
    /**
     * Displays backendNewsletter.php
     *
     * @return string
     */
    public function actionBackendNewsletter()
    {
        if (!Yii::$app->user->isGuest) {
            $this->layout = '/backend/standard';
            return $this->render('/backend/backendNewsletter');
        } else {
            // if user is not logged in
            $model = new User();
            $this->layout='/backend/login';
            return $this->render('/backend/login', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Displays backendPartner.php
     *
     * @return string
     */
    public function actionBackendPartner()
    {
        if (!Yii::$app->user->isGuest) {
            $cardMdl = new Card();
            $this->layout = '/backend/standard';
            return $this->render('/backend/backendPartner', [
                'model' => $cardMdl,
            ]);


        } else {
            // if user is not logged in
            $model = new User();
            $this->layout='/backend/login';
            return $this->render('/backend/login', [
                'model' => $model,
            ]);
        }
    }
}