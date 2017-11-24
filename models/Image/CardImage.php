<?php
/**
 * Created by PhpStorm.
 * User: Christoph Rohrmoser
 * Date: 28.08.2017
 * Time: 16:40
 */

namespace app\models\Image;

use yii\base\NotSupportedException;
use yii\db\ActiveRecord;
use yii\web\UploadedFile;

class CardImage extends ActiveRecord implements Image
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
        $this->path = 'image/uploads/' . $this->type . '/';
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
            if( !$file->saveAs(strtolower($this->path . $file->baseName . '.' . $file->extension))) {
                return false;
            }
        }
        return true;
    }
    /**
     * Saves image data to database
     *
     * @return integer
     */
    public function saveImageData()
    {
        foreach ($this->imageFiles as $file) {
            // save image data to database
            $this->name = strtolower($file->name);
            $this->size = $file->size;
            // make sure that the given record does not already exist in db
            if(!$imageMdl = $this::find()->where([
                'name' => strtolower($this->name),
                'size' => $this->size,
                'type' => strtolower($this->type)])->one()) {
                // save model and return id if successful
                $this->save();
                $this->refresh();

                return $this->id;
            } else {
                return $imageMdl->id;
            }

        }
        return false;
    }
    /**
     * Deletes image file from server
     *
     * @return bool
     */
    public function deleteImage()
    {
        if(unlink($this->path . $this->name)) {
            return true;
        }
        return false;
    }

    public function uploadThumbnail($file)
    {
        throw new NotSupportedException();
    }

    public function deleteThumbnail()
    {
        throw new NotSupportedException();
    }
    public function getRandomImage()
    {
        throw new NotSupportedException();
    }

}