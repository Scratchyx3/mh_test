<?php

/**
 * Created by PhpStorm.
 * User: Christoph Rohrmoser
 * Date: 28.08.2017
 * Time: 15:45
 */
namespace app\models\Image;

use yii\base\Exception;

class ImageFactory
{
    public static function create($baseType, $imageType)
    {
        switch($baseType) {
            case 'titleImage':
                $imageMdl = new TitleImage();
                $imageMdl->type = $imageType;
                $imageMdl->setPath();
                return $imageMdl;
                break;
            case 'galleryImage':
                $imageMdl = new GalleryImage();
                $imageMdl->type = $imageType;
                $imageMdl->setPath();
                return $imageMdl;
                break;
            case 'cardImage':
                $imageMdl = new CardImage();
                $imageMdl->type = $imageType;
                $imageMdl->setPath();
                return $imageMdl;
                break;
            default:
                throw new Exception('Image type not supported!');
        }
    }
}