<?php
/**
 * Created by PhpStorm.
 * User: Christoph Rohrmoser
 * Date: 07.11.2017
 * Time: 18:14
 */

namespace app\models;

use yii\db\ActiveRecord;

class OpeningHour extends ActiveRecord
{
    public static function tableName()
    {
        return 'opening_hour';
    }

    public $input_from_date;
    public $input_to_date;

    public function rules()
    {
        return [
            // date of opening is required
            [['input_from_date'], 'required', 'message' => 'Bitte Eröffnungstag auswählen!'],
            // date of closing is required
            [['input_to_date'], 'required', 'message' => 'Bitte letzten Heurigentag auswählen!'],
            // flag, whether its normal opening hours or a special event is required
            [['event'], 'required'],
            // flag, whether its normal opening hours or a special event is required
            [['event_name'], 'string', 'max' => 100, 'message' => 'Bitte nicht mehr als 100 Zeichen!'],
        ];
    }
}