<?php
/**
 * Created by PhpStorm.
 * User: Christoph Rohrmoser
 * Date: 28.08.2017
 * Time: 16:40
 */

namespace app\models\Image;

use yii\db\ActiveRecord;

class CardImage extends ActiveRecord implements Image
{
    public static function tableName()
    {
        return 'card';
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
        $this->path = 'image/uploads/cards/' . $this->type . '/';
    }

    public function getPath()
    {
        return $this->path;
    }

    public function uploadImage()
    {
        // TODO: Implement uploadImage() method.
    }

    public function uploadThumbnail($file)
    {
        // TODO: Implement uploadThumbnail() method.
    }

    public function saveImageData()
    {
        // TODO: Implement saveImageData() method.
    }

    public function deleteImage()
    {
        // TODO: Implement deleteImage() method.
    }

    public function deleteThumbnail()
    {
        // TODO: Implement deleteThumbnail() method.
    }

}