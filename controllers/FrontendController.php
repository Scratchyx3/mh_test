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
                $emailMdl->save() &&
                empty($emailMdl->antiSpam)) {
                    $emailMdl = new Email();
                    $emailMdl->setEmailSaved(true);

                $to = "rohrmoser.christoph91@gmail.com";
                $subject = "Newsletter-Anmeldung";
                $txt = $emailMdl->email;
                $headers = "From: Winzerhof-Mayer-Hörmann@veltliner.at";

                mail($to,$subject,$txt,$headers);
            }
        }
        $this->layout='/frontend/standard';
        return $this->render('/frontend/newsletterSignUp', [
            'model' => $emailMdl,
        ]);
    }

}

