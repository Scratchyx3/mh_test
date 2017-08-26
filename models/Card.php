<?php
/**
 * Created by PhpStorm.
 * User: Christoph Rohrmoser
 * Date: 24.08.2017
 * Time: 16:45
 */

namespace app\models;

use yii\db\ActiveRecord;

class Card extends ActiveRecord
{
    public static function tableName()
    {
        return 'card';
    }

    public function rules()
    {
        return [
            // headline is required
            [['headline'], 'required', 'message' => 'Bitte Überschrift wählen!'],
            // headline can not be longer than 100 characters
            [['headline'], 'string', 'max' => 100, 'message' => 'Bitte nicht mehr als 100 Zeichen!'],
            // text is required
            [['content'], 'required', 'message' => 'Bitte Text eingeben!'],
            // fkImage can not be longer than 50 characters
            [['fkImage'], 'string', 'max' => 120, 'message' => 'Bitte nicht mehr als 100 Zeichen!'],
            // headline can not be longer than 100 characters
            [['instagramLink'], 'string', 'max' => 100, 'message' => 'Bitte nicht mehr als 100 Zeichen!'],
            // headline can not be longer than 100 characters
            [['type'], 'required'],
            [['id'], 'integer'],

        ];
    }
}