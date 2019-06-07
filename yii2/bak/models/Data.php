<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "t_data".
 *
 * @property int $data_id
 * @property string $start_time
 * @property string $end_time
 * @property int $ruangan_id
 * @property int $user_id
 * @property int $status
 *
 * @property TUser $user
 * @property TDaftarruangan $ruangan
 */
class Data extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 't_data';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['start_time', 'end_time', 'ruangan_id', 'user_id'], 'required'],
            [['start_time', 'end_time'], 'safe'],
            [['ruangan_id', 'user_id', 'status'], 'integer'],
            [['user_id'], 'exist', 'skipOnError' => true, 'targetClass' => User::className(), 'targetAttribute' => ['user_id' => 'id']],
            [['ruangan_id'], 'exist', 'skipOnError' => true, 'targetClass' => Daftarruangan::className(), 'targetAttribute' => ['ruangan_id' => 'ruangan_id']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'data_id' => 'Data ID',
            'start_time' => 'Start Time',
            'end_time' => 'End Time',
            'ruangan_id' => 'Ruangan ID',
            'user_id' => 'User ID',
            'status' => 'Status',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getUser()
    {
        return $this->hasOne(User::className(), ['id' => 'user_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getRuangan()
    {
        return $this->hasOne(Daftarruangan::className(), ['ruangan_id' => 'ruangan_id']);
    }
}
