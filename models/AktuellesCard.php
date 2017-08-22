<?php
/**
 * Created by PhpStorm.
 * User: Christoph Rohrmoser
 * Date: 12.08.2017
 * Time: 17:38
 */

namespace app\models;


use yii\db\ActiveRecord;

class AktuellesCard extends ActiveRecord
{
    public static function tableName()
    {
        return 'aktuelles';
    }
}