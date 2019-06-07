<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "t_role".
 *
 * @property int $role_id
 * @property string $access_page
 *
 * @property TUser[] $tUsers
 */
class Role extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 't_role';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['access_page'], 'required'],
            [['access_page'], 'string', 'max' => 200],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'role_id' => 'Role ID',
            'access_page' => 'Access Page',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getUsers()
    {
        return $this->hasMany(User::className(), ['role_id' => 'role_id']);
    }
}
