<?php
/**
 * Created by PhpStorm.
 * User: Christoph Rohrmoser
 * Date: 19.09.2017
 * Time: 16:07
 */

namespace app\models;


use yii\db\ActiveRecord;

class Email extends ActiveRecord
{
    private $emailSaved = false;
    public $antiSpam;

    public static function tableName()
    {
        return 'email';
    }

    public function rules()
    {
        return [
            // email is required
            [['email'], 'required', 'message' => 'Bitte geben Sie Ihre Email-Adresse an!'],
            // email can not be longer than 100 chars
            [['email'], 'string', 'max' => 100, 'message' => 'Bitte nicht mehr als 100 Zeichen!'],
            // the email attribute should be a valid email address
            ['email', 'email'],
            // anti spam hidden field -> must be empty
            [['antiSpam'], 'string', 'max' => 0],
        ];
    }

    public function setEmailSaved($emailSaved) {
        $this->emailSaved = $emailSaved;
    }
    public function getEmailSaved() {
        return $this->emailSaved;
    }
}