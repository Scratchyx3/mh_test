<?php
/**
 * Created by PhpStorm.
 * User: Christoph Rohrmoser
 * Date: 13.07.2017
 * Time: 13:27
 */

namespace app\controllers;

use app\models\Card;
use app\models\Email;
use app\models\File;
use app\models\Image\ImageFactory;
use app\models\OpeningHour;
use DateTime;
use Yii;
use yii\web\Controller;
use yii\web\UploadedFile;

class BackendController extends Controller
{
    // =================== Image ===================
    /**
    * Saves image files to server and saves image data to database
    *
    * @var $imageType
    *
    * @return string
    */
    public function actionImageUpload() {
        if (Yii::$app->request->isPost) {
            $baseType = Yii::$app->request->post('baseType');
            $imageType = Yii::$app->request->post('imageType');
            $imageMdl = ImageFactory::create($baseType, $imageType);

            $imageMdl->imageFiles = UploadedFile::getInstances($imageMdl, 'imageFiles');

            // upload the image file and save image data to database
            if ($imageMdl->uploadImage() && $imageMdl->saveImageData()) {
                return json_encode(true);
            }
        }
        return json_encode(false);
    }
    /**
     * Deletes an image file from server and deletes image data from database
     *
     * @var $imageType
     * @var $key
     *  id of the image which should be deleted
     * @return string
     */
    public function actionImageDelete() {
        if (Yii::$app->request->isPost) {
            $id = Yii::$app->request->post('key');
            $baseType = Yii::$app->request->post('baseType');
            $imageType = Yii::$app->request->post('imageType');
            $imageMdl = ImageFactory::create($baseType, $imageType)->findOne($id);
            if( $imageMdl->deleteImage() &&
                $imageMdl->delete()) {
                return json_encode(true);
            }
        }
        return json_encode(false);
    }

    // =================== Files ===================

    public function actionFileUpload() {
        $fileType = Yii::$app->request->post('fileType');

        $fileMdl = new File();
        $fileMdl->type = $fileType;
        $fileMdl->setPath();

        $fileMdl->file = UploadedFile::getInstance($fileMdl, 'file');

        if($fileMdl->uploadFile() && $fileMdl->saveToDatabase()) {
            return json_encode(true);
        } else {
            return json_encode(false);
        }
    }
    public function actionFileDelete() {
        if (Yii::$app->request->isPost) {
            $id = Yii::$app->request->post('key');

            $fileMdl = File::findOne($id);
            // delete image from database
            $fileMdl->delete();
            // delete image file from server
            $fileMdl->deleteFile();

            return json_encode(true);
        }
        return json_encode(false);
    }

    // =================== Cards ===================

    public function actionCardUpload() {
        if (Yii::$app->request->isPost) {
            $cardMdl = new Card();
            $cardMdl->load(Yii::$app->request->post());
            $cardImageMdl = ImageFactory::create($cardMdl->baseType, $cardMdl->imageType);
            // get card image in model
            $cardImageMdl->imageFiles = UploadedFile::getInstances($cardImageMdl, 'imageFiles');
            $cardImageMdl->uploadImage();
            $fkImage = $cardImageMdl->saveImageData();

            $cardMdl->fkImage = intval($fkImage);
            // adding http:// to the link in case user didnt do it
            if(!empty($cardMdl->instagramLink) && strpos($cardMdl->instagramLink, 'http') === false) {
                $cardMdl->instagramLink = 'http://' . $cardMdl->instagramLink;
            }
            // get ranking of highest ranked card
            $highest_ranked_card = Card::find()
                ->where(['imageType' => $cardMdl->imageType])
                ->orderBy(['ranking'=>SORT_DESC])->one();

            if (count($highest_ranked_card) > 0) {
                $cardMdl->ranking = (int) ++$highest_ranked_card->ranking;
            } else {
                $cardMdl->ranking = 0;
            }

            // if card is not found in database -> save
            if (!Card::find()->where(['id' => $cardMdl->id])->exists()) {
                $cardMdl->save();
            } else {
                // if card already exists in database -> update
                if ($cardMdl->fkImage != 0) {
                    $cardMdl->updateAll([
                        'headline' => $cardMdl->headline,
                        'content' => $cardMdl->content,
                        'fkImage' => $fkImage,
                        'instagramLink' => $cardMdl->instagramLink,
                        'baseType' => $cardMdl->baseType,
                        'imageType' => $cardMdl->imageType,
                    ], ['id' => $cardMdl->id]);
                } else {
                    $cardMdl->updateAll([
                        'headline' => $cardMdl->headline,
                        'content' => $cardMdl->content,
                        'instagramLink' => $cardMdl->instagramLink,
                        'baseType' => $cardMdl->baseType,
                        'imageType' => $cardMdl->imageType,
                    ], ['id' => $cardMdl->id]);
                }
                $cardMdl = Card::findOne($cardMdl->id);
            }
            // return to previous view
            $this->layout = '/backend/standard';
            return $this->render('/backend/backend' . ucfirst(str_replace('card_', '', $cardMdl->imageType)), [
                'model' => $cardMdl,
            ]);
        }
        return Yii::$app->runAction('backend-site/backend-startseite');
    }

    public function actionRankUpCard() {
        if (Yii::$app->request->isGet) {
            $id = Yii::$app->request->get('id');
            $type = Yii::$app->request->get('type');
            if ($cardMdlRankUp = Card::findOne($id)) {
                $cardMdlRankDown = Card::find()
                    ->where(['and', 'imageType=:imageType', 'ranking<:ranking'])
                    ->addParams([':imageType' => $cardMdlRankUp->imageType, ':ranking' => $cardMdlRankUp->ranking])
                    ->orderBy(['ranking'=>SORT_DESC])->one();
                // if a card with lower rank exists
                if ($cardMdlRankDown != null) {
                    $cardMdlRankDown->ranking++;
                    while ($cardMdlRankUp->ranking >= $cardMdlRankDown->ranking) {
                        $cardMdlRankUp->ranking--;
                    }
                    $cardMdlRankDown->save();
                    $cardMdlRankUp->save();
                }
            }

            return Yii::$app->runAction('backend-site/backend-' . $type);
        }
        // return fallback
        return Yii::$app->runAction('backend-site/backend-landing-page');
    }

    public function actionRankDownCard() {
        if (Yii::$app->request->isGet) {
            $id = Yii::$app->request->get('id');
            $type = Yii::$app->request->get('type');
            if ($cardMdlRankDown = Card::findOne($id)) {
                $cardMdlRankUp = Card::find()
                    ->where(['and', 'imageType=:imageType', 'ranking>:ranking'])
                    ->addParams([':imageType' => $cardMdlRankDown->imageType, ':ranking' => $cardMdlRankDown->ranking])
                    ->orderBy(['ranking'=>SORT_ASC])->one();
                // if a card with higher rank exists
                if ($cardMdlRankUp != null) {
                    $cardMdlRankUp->ranking--;
                    while ($cardMdlRankUp->ranking >= $cardMdlRankDown->ranking) {
                        $cardMdlRankDown->ranking++;
                    }
                    $cardMdlRankDown->save();
                    $cardMdlRankUp->save();
                }
            }

            return Yii::$app->runAction('backend-site/backend-' . $type);
        }
        // return fallback
        return Yii::$app->runAction('backend-site/backend-landing-page');
    }

    public function actionDeleteCard() {
        if (Yii::$app->request->isGet) {
            $id = Yii::$app->request->get('id');
            $type = Yii::$app->request->get('type');
            if ($cardMdl = Card::findOne($id)) {
                $imageMdl = ImageFactory::create($cardMdl->baseType, $cardMdl->imageType)->findOne($cardMdl->fkImage);
                if($imageMdl->deleteImage()) {
                    $imageMdl->delete();
                }
                $cardMdl->delete();
            }

            return Yii::$app->runAction('backend-site/backend-' . $type);
        }
        // return fallback
        return Yii::$app->runAction('backend-site/backend-landing-page');
    }

    public function actionEditCard() {
        if (Yii::$app->request->isGet) {
            $id = Yii::$app->request->get('id');
            $type = Yii::$app->request->get('type');

            $cardMdl = Card::findOne($id);
            $site = ucfirst($type);

            return Yii::$app->runAction('backend-site/backend-edit', ['site' => $site, 'model' => $cardMdl]);
        }
        // return fallback
        return Yii::$app->runAction('backend-site/backend-landing-page');
    }

    public function actionTogglePublishCard () {
        if (Yii::$app->request->isGet) {
            $type = Yii::$app->request->get('type');
            $id = Yii::$app->request->get('id');

            if($cardMdl = Card::findOne($id)) {
                if ($cardMdl->published == 0) {
                    $cardMdl->published = 1;
                } else {
                    $cardMdl->published = 0;
                }
                $cardMdl->updateAll([
                    'published' => $cardMdl->published,
                ], ['id' => $cardMdl->id]);

                return Yii::$app->runAction('backend-site/backend-' . $type, ['model' => $cardMdl]);
            }
        }
        // return fallback
        return Yii::$app->runAction('backend-site/backend-landing-page');
    }

    // =================== E-mail ===================

    public function actionDeleteNewsletterEmail() {
        $id = Yii::$app->request->get('id');
        if($emailMdl = Email::findOne($id)) {
            $emailMdl -> delete();
        }
        return Yii::$app->runAction('backend-site/backend-newsletter');
    }

    // =================== Opening Hours ===================

    public function actionSaveOpeningHour() {
        if (Yii::$app->request->isPost) {
            $openingHourMdl = new OpeningHour();
            if ($openingHourMdl->load(Yii::$app->request->post())) {
                $newFromDate = DateTime::createFromFormat('d. M Y', $openingHourMdl->input_from_date);
                $newToDate = DateTime::createFromFormat('d. M Y', $openingHourMdl->input_to_date);

                $openingHourMdl->from_date = $newFromDate->format('Y-m-d');
                $openingHourMdl->to_date = $newToDate->format('Y-m-d');

                $openingHourMdl->save();
            }
        }
        return Yii::$app->runAction('backend-site/backend-opening-hours');
    }

    public function actionDeleteOpeningHour() {
        $id = Yii::$app->request->get('id');
        if($openingHourMdl = OpeningHour::findOne($id)) {
            $openingHourMdl->delete();
        }

        return Yii::$app->runAction('backend-site/backend-opening-hours');
    }
}