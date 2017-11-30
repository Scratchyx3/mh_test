<?php
/**
 * Created by PhpStorm.
 * User: Christoph Rohrmoser
 * Date: 19.09.2017
 * Time: 15:58
 */

namespace app\controllers;


use app\models\Email;
use Yii;
use yii\web\Controller;

class FrontendController extends Controller
{
    public function actionAddEmail() {
        $emailMdl = new Email();
        if (Yii::$app->request->isPost) {
            if( $emailMdl->load(Yii::$app->request->post()) &&
                !$emailMdl->find()->where(['email' => $emailMdl->email])->one() &&
                $emailMdl->save() &&
                empty($emailMdl->antiSpam)) {

                $to = Yii::$app->params[0]['newsletterEmail'];
                $subject = "Neue Newsletter-Anmeldung";
                $txt = "Neue Newsletter-Anmeldung:" . "<br>" . "E-Mail Adresse: " . $emailMdl->email;
                $from = "From: Winzerhof Mayer-Hörmann <mh@veltliner.at>";
                mail($to,$subject,$txt,$from);
            }
            $emailMdl = new Email();
            $emailMdl->setEmailSaved(true);
        }
        $this->layout='/frontend/standard';
        return $this->render('/frontend/newsletterSignUp', [
            'model' => $emailMdl,
        ]);
    }

}

