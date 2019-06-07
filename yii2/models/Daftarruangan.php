<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "t_daftarruangan".
 *
 * @property int $ruangan_id
 * @property string $ruangan_name
 *
 * @property TData[] $tDatas
 */
class Daftarruangan extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 't_daftarruangan';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['ruangan_name', 'ip_device'], 'required'],
            [['ruangan_name', 'ip_device', 'status'], 'string', 'max' => 200],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'ruangan_id' => 'Ruangan ID',
            'ip_device' => 'URL',
            'ruangan_name' => 'Ruangan Name',
            'status' => 'Status',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getDatas()
    {
        return $this->hasMany(Data::className(), ['ruangna_id' => 'ruangan_id']);
    }
}
