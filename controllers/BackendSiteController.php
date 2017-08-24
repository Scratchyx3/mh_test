<?php
/**
 * Created by PhpStorm.
 * User: Christoph Rohrmoser
 * Date: 12.08.2017
 * Time: 12:15
 */

namespace app\controllers;

use app\models\Card;
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
            $this->layout='/backend/standard';
            return $this->render('/backend/backendStartseite');
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
            $this->layout = '/backend/standard';
            return $this->render('/backend/backendHeuriger');
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
            $this->layout = '/backend/standard';
            return $this->render('/backend/backendWeinkeller');
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
            $cardModel = new Card();
            $this->layout = '/backend/standard';
            return $this->render('/backend/backendLagen', [
                'model' => $cardModel,
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
            $this->layout = '/backend/standard';
            return $this->render('/backend/backendAuszeichnungen');
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