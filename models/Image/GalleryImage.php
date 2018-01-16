<?php

/**
 * Created by PhpStorm.
 * User: Christoph Rohrmoser
 * Date: 28.08.2017
 * Time: 16:36
 */

namespace app\models\Image;

use Yii;
use yii\db\ActiveRecord;
use yii\db\Expression;
use yii\db\Query;
use yii\web\UploadedFile;

class GalleryImage extends ActiveRecord implements Image
{
    /**
     * @var UploadedFile[]
     */
    public $imageFiles;

    public static function tableName()
    {
        return 'image';
    }

    public function setType($imageType)
    {
        $this->type = $imageType;
    }

    public function getType()
    {
        return $this->type;
    }

    public function setPath()
    {
        $this->path = 'image/uploads/gallery_' . $this->type . '/';
    }

    public function getPath()
    {
        return $this->path;
    }
    /**
     * Uploads image file and thumbnail file to server
     *
     * @return bool
     */
    public function uploadImage()
    {
        foreach ($this->imageFiles as $file) {
            // upload the image
            if( !$file->saveAs(strtolower($this->path . $file->baseName . '.' . $file->extension)) ||
                !$this->uploadThumbnail($file)) {
                return false;
            }
        }
        return true;
    }
    /**
     * Uploads thumbnail file to server
     *
     * @return bool
     */
    public function uploadThumbnail($file)
    {
        // Datei und Faktor der Größenänderung
        $filename = strtolower($this->path . $file->baseName . '.' . $file->extension);
        // Typ der Ausgabe
        header('Content-Type: image/jpeg');
        // Neue Größe berechnen
        list($width, $height) = getimagesize($filename);

        if($width > 1900 || $height > 1200) {
            $percent = 0.3;
        } elseif ($width > 1400 || $height > 850) {
            $percent = 0.45;
        } elseif ($width > 850 || $height > 600) {
            $percent = 0.6;
        } else {
            $percent = 1;
        }

        $newWidth = $width * $percent;
        $newHeight = $height * $percent;
        // Bild laden
        $thumb = imagecreatetruecolor($newWidth, $newHeight);
        $source = imagecreatefromjpeg($filename);
        // Skalieren
        imagecopyresized($thumb, $source, 0, 0, 0, 0, $newWidth, $newHeight, $width, $height);
        // Save picture
        if(!imagejpeg($thumb, strtolower($this->path . 'thumbnail_' . $file->baseName . '.' . $file->extension), 80)) {
            return false;
        }
        return true;
    }
    /**
     * Saves image data to database
     *
     * @return bool
     */
    public function saveImageData()
    {
        foreach ($this->imageFiles as $file) {
            // save image data to database
            $this->name = strtolower($file->name);
            $this->thumbnailName = strtolower('thumbnail_' . $file->name);
            $this->size = $file->size;
            // make sure that the given record does not already exist in db
            if(!$this::find()->where(['name' => strtolower($this->name), 'size' => $this->size, 'type' => strtolower($this->type)])->one()) {
                if(!$this->save()) {
                    return false;
                }
            }
        }
        return true;
    }
    /**
     * Deletes image file from server
     *
     * @return bool
     */
    public function deleteImage()
    {
        if( unlink($this->path . $this->name) &&
            unlink($this->path . $this->thumbnailName)) {
            return true;
        }
        return false;
    }
    public function getRandomImage() {
        $session = Yii::$app->session;
        if (!$session->isActive) {
            $session->open();
        }
        if (!$session->has($this->type . 'Image')) {
            $images = (new Query())
                ->select(['*'])
                ->from('image')
                ->where(['type' => $this->type])
                ->orderBy(new Expression('rand()'))
                ->limit(10)
                ->all();

            $session->set($this->type . 'Image', $images);
            return $images;
        }
        return $session->get($this->type . 'Image');
    }
}