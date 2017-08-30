<?php
/**
 * Created by PhpStorm.
 * User: Christoph Rohrmoser
 * Date: 13.07.2017
 * Time: 13:27
 */

namespace app\controllers;

use app\models\File;
use app\models\Image\ImageFactory;
use Yii;
use yii\web\Controller;
use yii\web\UploadedFile;

class BackendController extends Controller
{
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
                $imageMdl->deleteThumbnail() &&
                $imageMdl->delete()) {
                return json_encode(true);
            }
        }
        return json_encode(false);
    }

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
    public function actionCardUpload() {
        // if post data exists
//        if (Yii::$app->request->isPost) {
//            $cardMdl = new Card();
//            $cardMdl->load(Yii::$app->request->post());
//            //if record exists in database
//            if(Card::find()->where( [ 'id' => $cardMdl->id ] )->exists()) {
//                $cardMdl->isNewRecord = false;
//                //if update was successful
//                if ($cardMdl->updateAll([
//                        'headline' => $cardMdl->headline,
//                        'content' => $cardMdl->content,
//                        'fkImage' => $cardMdl->fkImage,
//                        'instagramLink' => $cardMdl->instagramLink,
//                        'type' => $cardMdl->type
//                    ], ['id' => $cardMdl->id]) !== false) {
//                    $this->layout = '/backend/standard';
//                    return $this->render('/backend/backend' . ucfirst($cardMdl->type), [
//                        'model' => $cardMdl,
//                    ]);
//                } else {
//                    return false;
//                }
//                // new record
//            } else {
//                if($cardMdl->save()) {
//                    $this->layout = '/backend/standard';
//                    return $this->render('/backend/backend' . ucfirst($cardMdl->type), [
//                        'model' => $cardMdl,
//                    ]);
//                }
//            }
//        } else {
//            return false;
//        }
    }
}