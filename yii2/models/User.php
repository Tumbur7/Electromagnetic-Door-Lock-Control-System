<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "t_user".
 *
 * @property integer $id
 * @property string $username
 * @property string $password
 * @property string $acces_token
 * @property string $auth_key
 * @property string $fullname
 * @property integer $role_id
 *
 * @property TIzin[] $tIzins
 * @property TRole $role
 */
class User extends \yii\db\ActiveRecord implements \yii\web\IdentityInterface
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 't_user';
    }




  public static function findIdentity($id)
        {
          return static::findOne($id);
        }

        public static function findIdentityByAccessToken($token,$type = null)
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

        public function validateAuthKey($authKey)
        {
          return $this->getAuthKey() === $authKey;
        }

        // mem VALIDASI agar username dan Password bisa connect dari DATABASE

        public static function findByUsername($username)
        {
         return static::findOne(['username' => $username]);
        }


        // >>>  Validasi Password Setelah dilakukan HASH Password

        public function validatePassword($password)
        {
          if(is_null ($this->password))
            return false;
          // return $this->password === $password;
          return Yii::$app->getSecurity()->validatePassword($password, $this->password);
        }


        // ===================================================================//

        // >>>  fungsi untuk membuat HASH Password

        public function beforeSave($insert)
        {
         if(!parent::beforeSave($insert)){
           return false;
         }
         $this->auth_key = \Yii::$app->security->generateRandomString();
         $this->password = Yii::$app->getSecurity()->generatePasswordHash($this->password);
         return true;
        }





    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['username', 'password',  'role_id'], 'required'],
            [['role_id'], 'integer'],
            [['username'], 'string', 'max' => 225],
            [['password'], 'string', 'max' => 255],
            [['acces_token', 'auth_key'], 'string', 'max' => 250],
            [['fullname'], 'string', 'max' => 100],
            [['role_id'], 'exist', 'skipOnError' => true, 'targetClass' => Role::className(), 'targetAttribute' => ['role_id' => 'role_id']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'username' => 'Username',
            'password' => 'Password',
            'acces_token' => 'Acces Token',
            'auth_key' => 'Auth Key',
            'fullname' => 'Fullname',
            'role_id' => 'Role ID',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getIzins()
    {
        return $this->hasMany(Izin::className(), ['user_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getRole()
    {
        return $this->hasOne(Role::className(), ['role_id' => 'role_id']);
    }
}
