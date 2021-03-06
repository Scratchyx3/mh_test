<?php

namespace app\controllers;

use app\models\Card;
use app\models\Email;
use yii;
use yii\helpers\Url;
use yii\web\Controller;

class SiteController extends Controller
{
    /**
     * Displays backendLandingPage.php
     *
     * @return string
     */
    public function actionIndex()
    {
        $this->layout='/frontend/index';
        return $this->render('/frontend/index');
    }
    /**
     * Displays aktuelles.php
     *
     * @return string
     */
    public function actionAktuelles()
    {
        $this->layout='/frontend/anfahrt';
        return $this->render('/frontend/anfahrt');
    }
    /**
     * Displays heuriger.php
     *
     * @return string
     */
    public function actionHeuriger()
    {
        if($cardMdl = Card::find()->where(['imageType' => 'card_heuriger'])->one()) {
            $this->layout='/frontend/standard';
            return $this->render('/frontend/heuriger', [
                'model' => $cardMdl,
            ]);
        } else {
            return false;
        }
    }
    /**
     * Displays weinkeller.php
     *
     * @return string
     */
    public function actionWeinkeller()
    {
        if($cardMdl = Card::find()->where(['imageType' => 'card_weinkeller'])->one()) {
            $this->layout='/frontend/standard';
            return $this->render('/frontend/weinkeller', [
                'model' => $cardMdl,
            ]);
        } else {
            return false;
        }
    }
    /**
     * Displays weinkarte.php
     *
     * @return string
     */
    public function actionWeinkarte()
    {
        $this->layout='/frontend/standard';
        $url = Url::to('image/test.pdf');
        return Yii::$app->response->sendFile($url, 'test.pdf', ['inline'=>true]);
    }
    /**
     * Displays lagen.php
     *
     * @return string
     */
    public function actionLagen()
    {
        $this->layout='/frontend/standard';
        return $this->render('/frontend/lagen');
    }
    /**
     * Displays auszeichnungen.php
     *
     * @return string
     */
    public function actionAuszeichnungen()
    {
        $this->layout='/frontend/standard';
        return $this->render('/frontend/auszeichnungen');
    }
    /**
     * Displays anfahrt.php
     *
     * @return string
     */
    public function actionAnfahrt()
    {
        $this->layout='/frontend/anfahrt';
        return $this->render('/frontend/anfahrt');
    }
    /**
     * Displays backendLandingPage.php
     *
     * @return string
     */
    public function actionBackendLandingPage()
    {
        $this->layout='/backend/standard';
        return $this->render('/backend/backendLandingPage');
    }
    /**
     * Displays partner.php
     *
     * @return string
     */
    public function actionPartner()
    {
        $this->layout='/frontend/standard';
        return $this->render('/frontend/partner');
    }
    /**
     * Displays impressum.php
     *
     * @return string
     */
    public function actionImpressum()
    {
        $this->layout='/frontend/standard';
        return $this->render('/frontend/impressum');
    }
    /**
     * Displays newsletterSignUp.php
     *
     * @return string
     */
    public function actionNewsletterSignUp()
    {
        $emailMdl = new Email();
        $this->layout='/frontend/standard';
        return $this->render('/frontend/newsletterSignUp', [
            'model' => $emailMdl,
        ]);
    }
    /**
     * Displays english.php
     *
     * @return string
     */
    public function actionEnglish()
    {
        $this->layout='/frontend/english';
        return $this->render('/frontend/english');
    }

    /**
     * Displays englishMaps.php
     *
     * @return string
     */
    public function actionEnglishMaps()
    {
        $this->layout='/frontend/english';
        return $this->render('/frontend/englishMaps');
    }
}
