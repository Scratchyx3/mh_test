<?php

namespace app\controllers;

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
        $this->layout='/frontend/standard';
        return $this->render('/frontend/heuriger');
    }
    /**
     * Displays weinkeller.php
     *
     * @return string
     */
    public function actionWeinkeller()
    {
        $this->layout='/frontend/standard';
        return $this->render('/frontend/weinkeller');
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
     * Displays ueberUns.php
     *
     * @return string
     */
    public function actionUeberUns()
    {
        $this->layout='/frontend/standard';
        return $this->render('/frontend/ueberUns');
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
        $this->layout='/frontend/standard';
        return $this->render('/frontend/newsletterSignUp');
    }
}
