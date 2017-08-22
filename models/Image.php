<?php
/**
 * Created by PhpStorm.
 * User: Christoph Rohrmoser
 * Date: 13.07.2017
 * Time: 13:34
 */

namespace app\models;

use yii;
use yii\base\Exception;
use yii\db\ActiveRecord;
use yii\web\UploadedFile;

class Image extends ActiveRecord
{
    /**
     * @var UploadedFile[]
     */
    public $imageFiles;

    const PATH_STARTSEITE = 'image/uploads/startseite/';
    const PATH_HEURIGER = 'image/uploads/heuriger/';
    const PATH_WEINKELLER = 'image/uploads/weinkeller/';
    const PATH_LAGEN = 'image/uploads/lagen/';
    const PATH_AUSZEICHNUNGEN = 'image/uploads/auszeichnungen/';
    const PATH_UEBER_UNS = 'image/uploads/ueber_uns/';
    const PATH_GALLERY_WEINKELLER = 'image/uploads/gallery_weinkeller/';
    const PATH_GALLERY_HEURIGER = 'image/uploads/gallery_heuriger/';

    public static function tableName()
    {
        return 'image';
    }

    public function setPath() {
        switch($this->type) {
            case 'startseite':
                $this->path = self::PATH_STARTSEITE;
                break;
            case 'heuriger':
                $this->path = self::PATH_HEURIGER;
                break;
            case 'weinkeller':
                $this->path = self::PATH_WEINKELLER;
                break;
            case 'lagen':
                $this->path = self::PATH_LAGEN;
                break;
            case 'auszeichnungen':
                $this->path = self::PATH_AUSZEICHNUNGEN;
                break;
            case 'ueberUns':
                $this->path = self::PATH_UEBER_UNS;
                break;
            case 'gallery_weinkeller':
                $this->path = self::PATH_GALLERY_WEINKELLER;
                break;
            case 'gallery_heuriger':
                $this->path = self::PATH_GALLERY_HEURIGER;
                break;
            default:
                throw new Exception('Could not set file path, parameter unknown.');
        }
    }
    /**
     * Uploads an image file to server
     *
     * @return bool
     */
    public function uploadFile() {
        if ($this->validate()) {
            foreach ($this->imageFiles as $file) {
                // upload the image
                $file->saveAs(strtolower($this->path . $file->baseName . '.' . $file->extension));
                // Datei und Faktor der Größenänderung
                $filename = strtolower($this->path . $file->baseName . '.' . $file->extension);
                $percent = 0.3;
                // Typ der Ausgabe
                header('Content-Type: image/jpeg');
                // Neue Größe berechnen
                list($width, $height) = getimagesize($filename);
                $newwidth = $width * $percent;
                $newheight = $height * $percent;
                // Bild laden
                $thumb = imagecreatetruecolor($newwidth, $newheight);
                $source = imagecreatefromjpeg($filename);
                // Skalieren
                imagecopyresized($thumb, $source, 0, 0, 0, 0, $newwidth, $newheight, $width, $height);

                imagejpeg($thumb, strtolower($this->path . 'thumbnail_' . $file->baseName . '.' . $file->extension), 80);
            }
            return true;
        } else {
            return false;
        }
    }
    /**
     * Saves image data to database
     *
     * @return bool
     */
    public function saveToDatabase() {
        foreach ($this->imageFiles as $file) {
            // save image data to database
            $this->name = strtolower($file->name);
            $this->thumbnailName = strtolower('thumbnail_' . $file->name);
            $this->size = $file->size;
            // make sure that the given record does not already exist in db
            if(!Image::find()->where(['name' => strtolower($this->name), 'size' => $this->size, 'path' => strtolower($this->path), 'type' => strtolower($this->type)])->one()) {
                $this->save();
            }
        }
    }
    /**
     * Deletes image file from server
     *
     * @return bool
     */
    public function deleteFile() {
        if(unlink($this->path . $this->name) && unlink($this->path . $this->thumbnailName)) {
            return true;
        }
        return false;
    }
    /**
     * Returns the path to a random image
     *
     * @return string
     */
    public function getRndImagePath() {
        $type = $this->type;
        // count number of images in database
        $sql = "SELECT COUNT(*) as images FROM image WHERE type = '$type'";
        $command = Yii::$app->db->createCommand($sql);
        $results = $command->queryAll();
        $numImages = (int)$results[0]["images"];

        $rndId = rand(1, $numImages) - 1;

        $images = $this -> find()->where(['type' => $type])->all();

        $randomImage = $images[$rndId];

        $imagePath = $randomImage -> path . $randomImage -> name;
        return $imagePath;
    }
}