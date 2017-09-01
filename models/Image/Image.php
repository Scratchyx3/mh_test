<?php

/**
 * Created by PhpStorm.
 * User: Christoph Rohrmoser
 * Date: 28.08.2017
 * Time: 15:13
 */
namespace app\models\Image;

interface Image
{
    public function setType($imageType);
    public function getType();
    public function setPath();
    public function getPath();
    public function uploadImage();
    public function uploadThumbnail($file);
    public function saveImageData();
    public function deleteImage();
    public function getRandomImage();
}