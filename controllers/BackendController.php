<?php
/**
 * Created by PhpStorm.
 * User: Christoph Rohrmoser
 * Date: 13.07.2017
 * Time: 13:27
 */

namespace app\controllers;

use app\models\File;
use app\models\Image;
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
            $imageType = Yii::$app->request->post('imageType');
            $imageMdl = new Image();
            $imageMdl -> type = $imageType;
            $imageMdl->setPath();

            $imageMdl->imageFiles = UploadedFile::getInstances($imageMdl, 'imageFiles');
            // upload the image file and save image data to database
            if ($imageMdl->uploadFile() && $imageMdl->saveToDatabase()) {
                return json_encode(true);
            }
        }
        return json_encode(false);
    }
    /**
     * Deletes an image file from server and deletes image data from database
     *
     * @var $imageType
     * @var key
     *  id of the image which should be deleted
     * @return string
     */
    public function actionImageDelete() {
        if (Yii::$app->request->isPost) {
            $id = Yii::$app->request->post('key');
            $imageMdl = Image::findOne($id);
            // delete image from database
            $imageMdl->delete();
            // delete image file from server
            $imageMdl->deleteFile();

            return json_encode(true);
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
}