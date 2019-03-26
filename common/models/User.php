<?php

namespace common\models;

use Yii;
use yii\web\IdentityInterface;

/**
 * This is the model class for table "user".
 *
 * @property string $id
 * @property string $login
 * @property string $password
 * @property string $fname
 * @property string $lname
 * @property string $mname
 * @property string $email
 * @property string $avatar
 * @property string $phone
 * @property string $last_activity_date
 *
 * @property Album[] $albums
 * @property FridaySermon[] $fridaySermons
 * @property Media[] $media
 * @property News[] $news
 */
class User extends \yii\db\ActiveRecord implements IdentityInterface
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
            [['last_activity_date'], 'safe'],
            [['login', 'password', 'avatar'], 'string', 'max' => 255],
            [['fname', 'lname', 'mname', 'email', 'phone', 'salt'], 'string', 'max' => 100],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'login' => 'Логин',
            'password' => 'Пароль',
            'fname' => 'Имя',
            'lname' => 'Фамилия',
            'mname' => 'Отчество',
            'email' => 'Email',
            'avatar' => 'Аватар',
            'phone' => 'Телефон',
            'last_activity_date' => 'Дата последней активности',
            'salt' => 'Соль'
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getAlbums()
    {
        return $this->hasMany(Album::className(), ['user_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getFridaySermons()
    {
        return $this->hasMany(FridaySermon::className(), ['user_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getMedia()
    {
        return $this->hasMany(Media::className(), ['user_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getNews()
    {
        return $this->hasMany(News::className(), ['user_id' => 'id']);
    }

    /**
     * @inheritdoc
     */
    public static function findIdentity($id)
    {
        return static::findOne(['id' => $id]);
    }

    /**
     * @param string $token
     * @param string $type
     * @return UserProfile
     */
    public static function findIdentityByAccessToken($token, $type = null)
    {
        $accessToken = AccessToken::findOne([
            'provider' => 'young',
            'type' => 'bearer',
            'token' => $token
        ]);

        if($accessToken && $accessToken->isValid()){
            return $accessToken->userProfile;
        }
    }

    /**
     * Finds user by username
     *
     * @param string $username
     * @return static|null
     */
    public static function findByUsername($username)
    {
        return static::findOne(['email' => $username]);
    }

    /**
     * Finds user by password reset token
     *
     * @param string $token password reset token
     * @return static|null
     */
    public static function findByPasswordResetToken($token)
    {
        if (!static::isPasswordResetTokenValid($token)) {
            return null;
        }

        return static::findOne([
            'password_reset_token' => $token,
            'status' => self::STATUS_ACTIVE,
        ]);
    }

    /**
     * Finds out if password reset token is valid
     *
     * @param string $token password reset token
     * @return boolean
     */
    public static function isPasswordResetTokenValid($token)
    {
        if (empty($token)) {
            return false;
        }

        $timestamp = (int) substr($token, strrpos($token, '_') + 1);
        $expire = Yii::$app->params['user.passwordResetTokenExpire'];
        return $timestamp + $expire >= time();
    }

    /**
     * @inheritdoc
     */
    public function getId()
    {
        return $this->getPrimaryKey();
    }

    /**
     * @inheritdoc
     */
    public function getAuthKey()
    {
        return $this->auth_key;
    }

    /**
     * @inheritdoc
     */
    public function validateAuthKey($authKey)
    {
        return $this->getAuthKey() === $authKey;
    }

    /**
     * Validates password
     *
     * @param string $password password to validate
     * @return boolean if password provided is valid for current user
     */
    public function validatePassword($password)
    {
        return $this->hash($password) === $this->password;
    }

    /**
     * Generates password hash from password and sets it to the model
     *
     * @param string $password
     */
    public function setPassword($password)
    {
        $this->password = $this->hash($password);
    }

    /**
     * @param string $password
     * @return string
     */
    private function hash($password)
    {
        $a =  md5($this->salt.$password.$this->salt);
        return md5($this->salt.$password.$this->salt);
    }

    /**
     * @return string
     */
    public function getFullName()
    {
        return $this->fname.' '.$this->lname;
    }

    /**
     * @return bool
     */
    public function beforeValidate()
    {
        if(!$this->login){
            $this->login = $this->email;
        }
        return parent::beforeValidate();
    }
}
