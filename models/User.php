<?php

namespace app\models;

use yii;
use yii\base\NotSupportedException;
use yii\db\ActiveRecord;
use yii\web\IdentityInterface;

class User extends ActiveRecord implements IdentityInterface
{
    private $identity = false;

    private $message;

    /**
     * Get the value of Message
     *
     * @return mixed
     */
    public function getMessage()
    {
        return $this->message;
    }

    /**
     * Set the value of Message
     *
     * @param mixed message
     *
     * @return self
     */
    public function setMessage($message)
    {
        $this->message = $message;

        return $this;
    }

    /**
     * @return array the validation rules.
     */
    public function rules()
    {
        return [
            // username is required
            [['username'], 'required', 'message' => 'Bitte wähle einen Usernamen!'],
            // remove whitespaces before and after
            [['username', 'password'], 'trim'],
            // password is required
            [['password'], 'required', 'message' => 'Bitte wähle ein Passwort!'],
            // username is validated by validateUsername()
            ['username', 'validateUsername'],
            // password is validated by validatePassword()
            ['password', 'validatePassword'],
        ];
    }
    /**
     * Logs in a user using the provided username and password.
     * @return bool user is logged in successfully
     */
    public function login()
    {
        if($this->validate()) {
            return Yii::$app->user->login($this->identity);
        }
        return false;

    }
    /**
     * Checks if username exists in database
     * @return bool user exists in database and account is active
     */
    public function validateUsername() {
        // if username exists in database
        if($this->identity = $this->findIdentity(['username' => $this->username])) {
            return true;
        // username does not exist in database
        } else {
            $this->addError('username', 'Dieser Username existiert nicht!');
            return false;
        }
    }
    /**
     * Checks if the given password matches the given username
     * @return bool user exists in database and password is correct
     */
    public function validatePassword() {
            if(!isset($this->identity)) {
                return false;
            }
            // login data correct
            if(md5($this->password) == $this->identity->password) {
                return true;
            // wrong password
            } else {
                $this->addError('password', 'Dieses Passwort ist nicht korrekt!');
            }
        return false;
    }
    /**
     * Returns an ID that can uniquely identify a user identity.
     * @return string|integer an ID that uniquely identifies a user identity.
     */
    public function getId()
    {
        return $this->id;
    }
    /**
     * Finds an identity by the given ID.
     * @param string|integer $id the ID to be looked for
     * @return IdentityInterface the identity object that matches the given ID.
     * Null should b    e returned if such an identity cannot be found
     * or the identity is not in an active state (disabled, deleted, etc.)
     */
    public static function findIdentity($id)
    {
        return static::findOne($id);
    }

    public static function findIdentityByAccessToken($token, $type = null)
    {
        throw new NotSupportedException();
    }
    public function getAuthKey()
    {
        throw new NotSupportedException();
    }

    public function validateAuthKey($authKey)
    {
        throw new NotSupportedException();
    }
}
