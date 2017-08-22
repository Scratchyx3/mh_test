<?php

namespace app\controllers;

use app\models\User;
use yii;
use yii\filters\AccessControl;
use yii\filters\VerbFilter;
use yii\web\Controller;

class LoginController extends Controller
{
    /**
     * @inheritdoc
     */
    public function  behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::className(),
                'only' => ['logout'],
                'rules' => [
                    [
                        'actions' => ['logout'],
                        'allow' => true,
                        'roles' => ['@'],
                    ],
                ],
            ],
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'logout' => ['post'],
                ],
            ],
        ];
    }

    /**
     * @inheritdoc
     */
    public function actions()
    {
        return [
            'error' => [
                'class' => 'yii\web\ErrorAction',
            ],
            'captcha' => [
                'class' => 'yii\captcha\CaptchaAction',
                'fixedVerifyCode' => YII_ENV_TEST ? 'testme' : null,
            ],
        ];
    }

    /**
     * Displays backend
     *
     * @return string
     */
    public function actionIndex()
    {
        $this->layout='/backend/standard';
        // if user is already logged in => redirect to backend landing page
        if (!Yii::$app->user->isGuest) {
            return $this->render('/backend/backendLandingPage');
        }
        // if user is not logged in and post data exists => try to log user in
        $model = new User();
        if ($model->load(Yii::$app->request->post()) && $model->login()) {
            return $this->render('/backend/backendLandingPage');
        }
        // if user is not logged in and there is no post data
        $this->layout='/backend/login';
        return $this->render('/backend/login', [
            'model' => $model,
        ]);
    }
    /**
     * Logout action.
     *
     * @return string
     */
    public function actionLogout()
    {
        Yii::$app->user->logout();
        return $this->goHome();
    }
}
