<?php
/**
 * Created by PhpStorm.
 * User: Christoph Rohrmoser
 * Date: 08.08.2017
 * Time: 12:10
 */

namespace app\models;

use yii\base\Exception;
use yii\db\ActiveRecord;

class File extends ActiveRecord
{

    const PATH_WEINKARTE = 'file_upload/weinkarte/';
    const PATH_SPEISEKARTE = 'file_upload/speisekarte/';

    public $file;

    public static function tableName()
    {
        return 'file';
    }

    public function setPath() {
        switch($this->type) {
            case 'weinkarte':
                $this->path = self::PATH_WEINKARTE;
                break;
            case 'speisekarte':
                $this->path = self::PATH_SPEISEKARTE;
                break;
            default:
                throw new Exception('Could not set file path, parameter unknown.');
        }
    }

    public function uploadFile() {
        // set file path
        $filePath = $this->path . $this->type . '.' . $this->file->extension;
        // upload the file
        if ($this->file->saveAs($filePath)) {
            return true;
        } else {
            return false;
        }

    }
    public function saveToDatabase() {
        // save file data to database
        $this->name = $this->type . '.' . $this->file->extension;
        // make sure that the given record does not already exist in db
        if(!File::find()->where(['name' => $this->name, 'path' => $this->path, 'type' => $this->type])->one()) {
            $this->save();
        }
    }
    public function deleteFile() {
        if(unlink($this->path . $this->name)) {
            return true;
        }
        return false;
    }

}