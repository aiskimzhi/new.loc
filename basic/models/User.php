<?php

namespace app\models;

use Yii;
use yii\db\ActiveRecord;
use yii\web\IdentityInterface;

/**
 * This is the model class for table "user".
 *
 * @property integer $id
 * @property string $first_name
 * @property string $last_name
 * @property string $password
 * @property string $email
 * @property string $skype
 * @property string $phone
 * @property string $auth_key
 * @property string $password_reset_token
 *
 * @property Advert[] $adverts
 * @property Bookmark[] $bookmarks
 */
class User extends ActiveRecord implements IdentityInterface
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'user';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['first_name', 'last_name', 'password', 'email', 'auth_key', 'password_reset_token'], 'required'],
            [['auth_key', 'password_reset_token'], 'string', 'max' => 32],
            ['skype', 'string', 'max' => 255],
            ['phone', 'integer'],
            ['email', 'email']
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'first_name' => 'First Name',
            'last_name' => 'Last Name',
            'password' => 'Password',
            'email' => 'E-mail',
            'skype' => 'Skype',
            'phone' => 'Phone',
            'auth_key' => 'Auth Key',
            'password_reset_token' => 'Password Reset Token',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getAdverts()
    {
        return $this->hasMany(Advert::className(), ['user_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getBookmarks()
    {
        return $this->hasMany(Bookmark::className(), ['user_id' => 'id']);
    }

    /**
     * from IdentityInterface
     */
    public static function findIdentity($id)
    {
        return static::findOne($id);
    }

    public static function findIdentityByAccessToken($token, $type = null)
    {
        return static::findOne(['access_token' => $token]);
    }

    public function getId()
    {
        return $this->id;
    }

    public function getAuthKey()
    {
        return $this->auth_key;
    }

    public function validateAuthKey($auth_key)
    {
        return $this->auth_key === $auth_key;
    }

    /**
     * It was taken from Advanced template common/models/User
     */
    public function setPassword($password)
    {
        $this->password = Yii::$app->security->generatePasswordHash($password);
    }

    public function validatePassword($password)
    {
        return Yii::$app->security->validatePassword($password, $this->password);
    }

    public function generateAuthKey()
    {
        $this->auth_key = Yii::$app->security->generateRandomString();
    }

    public function generatePasswordResetToken()
    {
        $this->password_reset_token = Yii::$app->security->generateRandomString();
    }

    /**
     * this is a full name string for Logout label
     */
    public function getFullName()
    {
        return $this->first_name . ' ' . $this->last_name;
    }

    public static function findByEmail($email)
    {
        return static::findOne(['email' => $email]);
    }

    public static function findById()
    {
        return Yii::$app->user->identity->getId();
    }

    public static function isPasswordResetTokenValid($token)
    {
        if (empty($token)) {
            return false;
        }
        $timestamp = (int) substr($token, strrpos($token, '_') + 1);
        $expire = 86400;
        //$expire = Yii::$app->params['user.passwordResetTokenExpire'];
        return $timestamp + $expire >= time();
    }

    public static function findByPasswordResetToken($token)
    {
        if (!static::isPasswordResetTokenValid($token)) {
            return null;
        }
        return static::findOne([
            'password_reset_token' => $token,
            //'status' => self::STATUS_ACTIVE,
        ]);
    }

    public static function getAllIds()
    {
        $command = 'SELECT id FROM ' . self::tableName();
        $arr = Yii::$app->db->createCommand($command)
            ->queryAll();

        for ($i = 0; $i < count($arr); $i++) {
            $n[$i] = $arr[$i]['id'];
        }

        return $n;
    }

    public function getSkype()
    {
        $command = 'SELECT skype FROM user WHERE id = :id';
        return Yii::$app->db->createCommand($command, [':id' => Yii::$app->user->identity->getId()])->queryOne();


    }

}
