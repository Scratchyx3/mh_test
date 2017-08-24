<?php
/**
 * Created by PhpStorm.
 * User: Christoph Rohrmoser
 * Date: 24.08.2017
 * Time: 16:45
 */

namespace app\models;

use yii\base\Model;

class Card extends Model
{
    public $content;
    public $headline;
    public $fkImage;
    public $instagramLink;

    public function rules()
    {
        return [
            // headline is required
            [['headline'], 'required', 'message' => 'Bitte Überschrift wählen!'],
            // headline can not be longer than 50 characters
            [['headline'], 'string', 'max' => 60, 'message' => 'Bitte nicht mehr als 60 Zeichen!'],
            // text is required
            [['content'], 'required', 'message' => 'Bitte Text eingeben!'],
            // headline can not be longer than 50 characters
            [['fkImage'], 'string', 'max' => 120, 'message' => 'Bitte nicht mehr als 60 Zeichen!'],
            // headline can not be longer than 50 characters
            [['instagramLink'], 'string', 'max' => 120, 'message' => 'Bitte nicht mehr als 60 Zeichen!'],
        ];
    }
}